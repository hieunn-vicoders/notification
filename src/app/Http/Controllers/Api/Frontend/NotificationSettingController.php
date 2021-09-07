<?php

namespace VCComponent\Laravel\Notification\Http\Controllers\Api\Frontend;

use Exception;
use Illuminate\Http\Request;
use NF\Roles\Models\Role;
use VCComponent\Laravel\Notification\Entities\Notification;
use VCComponent\Laravel\Notification\Repositories\NotificationSettingRepository;
use VCComponent\Laravel\Notification\Transformers\NotificationSettingTransformer;
use VCComponent\Laravel\Notification\Validators\NotificationSettingValidator;
use VCComponent\Laravel\User\Entities\UserHasRole;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class NotificationSettingController extends ApiController {

    protected $repository;
    protected $entity;
    protected $validator;
    protected $transformer;
    protected $user;

    public function __construct(NotificationSettingRepository $repository, NotificationSettingValidator $validator, NotificationSettingTransformer $transformer) 
    {
        $this->repository   = $repository;
        $this->entity       = $repository->getEntity();
        $this->validator    = $validator;
        $this->transformer  = $transformer;

        $this->middleware('jwt.auth', ['except' => []]);
        $this->user = $this->getAuthenticatedUser();
        
        if (!empty(config('webpress-notification.auth_middleware.frontend'))) {
            foreach (config('webpress-notification.auth_middleware.frontend') as $middleware) {
                $this->middleware($middleware['middleware'], ['except' => $middleware['except']]);
            }
        }

        if (config('webpress-notification.transformers.notification-setting')) {
            $this->transformer = config('webpress-notification.transformers.notification-setting');
        } else {
            $this->transformer  = $transformer;
        }
    }

    public function getSetting(Request $request) 
    {
        $user_notification_settings = $this->entity->getUserSetting($this->user->id);
        
        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        return $this->response->collection($user_notification_settings, $transformer);
    }

    public function getConfigableNotification(Request $request) 
    {
        $user_notification_settings = $this->entity->getUserConfigableNotifications($this->user->id);
        
        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        return $this->response->collection($user_notification_settings, $transformer);
    }

    public function syncSetting(Request $request) {
        $this->validator->isValid($request, "SYNC_USER_NOTIFICATION_SETTING");

        $notification_ids = array_unique(array_merge(
            $request->input('email_template_ids'),
            $request->input('mobile_template_ids'),
            $request->input('web_template_ids')
        ), SORT_NUMERIC);

        $notification_setting_datas = $this->formatNotificationSettingData($request, collect($notification_ids));

        $this->entity->where('notificationable_id', $this->user->id)->whereIn('notification_id', $notification_ids)->where('notificationable_type', $this->entity::TYPE_USER)->delete();

        $this->entity->insert($notification_setting_datas);

        return $this->success();
    }

    protected function formatNotificationSettingData(Request $request, $notification_ids) {       
        Notification::findOrFail($notification_ids);

        $email_template_ids     = $request->input('email_template_ids');
        $mobile_template_ids    = $request->input('mobile_template_ids');
        $web_template_ids       = $request->input('web_template_ids');

        return $notification_ids->map(function ($notification_id) use ($email_template_ids, $mobile_template_ids, $web_template_ids) {
            return [
                'notification_id'       => $notification_id,
                'notificationable_id'   => $this->user->id,
                'email_enable'          => in_array($notification_id, $email_template_ids)? $this->entity::ENABLE : $this->entity::DISABLE, 
                'mobile_enable'         => in_array($notification_id, $mobile_template_ids)? $this->entity::ENABLE : $this->entity::DISABLE, 
                'web_enable'            => in_array($notification_id, $web_template_ids)? $this->entity::ENABLE : $this->entity::DISABLE, 
                'notificationable_type'                  => $this->entity::TYPE_USER,
            ];
        })->toArray();

    }
}