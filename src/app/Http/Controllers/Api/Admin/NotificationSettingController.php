<?php

namespace VCComponent\Laravel\Notification\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use NF\Roles\Models\Role;
use VCComponent\Laravel\Notification\Entities\Notification;
use VCComponent\Laravel\Notification\Repositories\NotificationSettingRepository;
use VCComponent\Laravel\Notification\Transformers\NotificationSettingTransformer;
use VCComponent\Laravel\Notification\Validators\NotificationSettingValidator;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;
use VCComponent\Laravel\Vicoders\Core\Exceptions\NotFoundException;

class NotificationSettingController extends ApiController {

    protected $repository;
    protected $entity;
    protected $validator;
    protected $transformer;

    public function __construct(NotificationSettingRepository $repository, NotificationSettingValidator $validator, NotificationSettingTransformer $transformer) 
    {
        $this->repository   = $repository;
        $this->entity       = $repository->getEntity();
        $this->validator    = $validator;
        $this->transformer  = $transformer;

        if (!empty(config('webpress-notification.auth_middleware.admin'))) {
            $user = $this->getAuthenticatedUser();
            foreach (config('webpress-notification.auth_middleware.admin') as $middleware) {
                $this->middleware($middleware['middleware'], ['except' => $middleware['except']]);
            }
        }
        else{
            throw new Exception("Admin middleware configuration is required");
        }

        if (config('webpress-notification.transformers.notification-setting')) {
            $this->transformer = config('webpress-notification.transformers.notification-setting');
        } else {
            $this->transformer  = $transformer;
        }
    }

    public function getSetting(Request $request, $role_id) 
    {

        $role = Role::find($role_id);
        if (!$role) {
            throw new NotFoundException('Role');
        }
        
        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        $notification_settings = $this->entity->where('notificationable_id', $role_id)->where('notificationable_type', $this->entity::TYPE_ROLE)->with('notification')->get();

        return $this->response->collection($notification_settings, $transformer);
    }

    public function syncSetting(Request $request) {
        $this->validator->isValid($request, "SYNC_WEBSITE_NOTIFICATION_SETTING");

        $role = Role::find($request->input('role_id'));
        if (!$role) {
            throw new NotFoundException('Role');
        }

        $notification_ids = array_unique(array_merge(
            $request->input('email_template_ids'),
            $request->input('mobile_template_ids'),
            $request->input('web_template_ids')
        ), SORT_NUMERIC);

        $notification_setting_datas = $this->formatNotificationSettingData($request, collect($notification_ids));

        $this->entity->where('notificationable_id', $request->role_id)->whereIn('notification_id', $notification_ids)->where('notificationable_type', $this->entity::TYPE_ROLE)->delete();

        $this->entity->insert($notification_setting_datas);

        return $this->success();
    }

    protected function formatNotificationSettingData(Request $request, $notification_ids) {          
        $notifications = Notification::whereIn('id',$notification_ids)->get();

        if ($notifications->count() < $notification_ids->count()) {
            throw new NotFoundException('Notification');
        }

        $email_template_ids     = $request->input('email_template_ids');
        $mobile_template_ids    = $request->input('mobile_template_ids');
        $web_template_ids       = $request->input('web_template_ids');
        $role_id                = $request->input('role_id');

        return $notification_ids->map(function ($notification_id) use ($email_template_ids, $mobile_template_ids, $web_template_ids, $role_id) {
            return [
                'notification_id'       => $notification_id,
                'notificationable_id'   => $role_id,
                'email_enable'          => in_array($notification_id, $email_template_ids)? $this->entity::ENABLE : $this->entity::DISABLE, 
                'mobile_enable'         => in_array($notification_id, $mobile_template_ids)? $this->entity::ENABLE : $this->entity::DISABLE, 
                'web_enable'            => in_array($notification_id, $web_template_ids)? $this->entity::ENABLE : $this->entity::DISABLE,
                'notificationable_type'                  => $this->entity::TYPE_ROLE, 
            ];
        })->toArray();

    }
}