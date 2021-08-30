<?php

namespace VCComponent\Laravel\Notification\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use VCComponent\Laravel\Notification\Repositories\NotificationRepository;
use VCComponent\Laravel\Notification\Transformers\NotificationTransformer;
use VCComponent\Laravel\Notification\Validators\NotificationValidator;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class NotificationController extends ApiController {

    protected $repository;
    protected $entity;
    protected $validator;
    protected $transformer;

    public function __construct(NotificationRepository $repository, NotificationValidator $validator, NotificationTransformer $transformer) 
    {
        $this->repository   = $repository;
        $this->entity       = $repository->getEntity();
        $this->validator    = $validator;
        
        if (!empty(config('webpress-notification.auth_middleware.admin'))) {
            $user = $this->getAuthenticatedUser();
            foreach (config('webpress-notification.auth_middleware.admin') as $middleware) {
                $this->middleware($middleware['middleware'], ['except' => $middleware['except']]);
            }
        }
        else{
            throw new Exception("Admin middleware configuration is required");
        }

        if (config('webpress-notification.transformers.notification')) {
            $this->transformer = config('webpress-notification.transformers.notification');
        } else {
            $this->transformer  = $transformer;
        }
    }

    public function index(Request $request) {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['name'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        if ($request->has('page')) {
            $per_page = $request->has('per_page') ? (int) $request->get('per_page') : 15;
            $notifications    = $query->paginate($per_page);
            
            return $this->response->paginator($notifications, $transformer);
        }
        $notifications = $query->get();
            
        return $this->response->collection($notifications, $transformer);
    }

    public function show(Request $request, $id) {
        $notification = $this->repository->findById($id);

        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        return $this->response->item($notification, $transformer);
    }

    public function store(Request $request)
    {
        $this->validator->isValid($request, 'RULE_ADMIN_CREATE');

        $data = $request->all();

        if ($request['slug']) {
            $data['slug'] = Str::slug($request['slug']);
        } else {
            $data['slug'] = Str::slug($request['name']);
        }

        $notification  = $this->repository->create($data);

        return $this->response->item($notification, new $this->transformer());
    }

    public function update(Request $request, $id)
    { 
        $notification = $this->repository->findById($id);

        $this->validator->isValid($request, 'RULE_ADMIN_UPDATE');

        $data = $request->all();

        $notification  = $this->repository->update($data, $id);

        return $this->response->item($notification, new $this->transformer());
    }

    public function destroy($id)
    {
        $notificatioin = $this->repository->findById($id);

        $this->repository->delete($id);

        return $this->success();
    }
}