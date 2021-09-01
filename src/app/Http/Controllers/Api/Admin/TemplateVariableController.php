<?php

namespace VCComponent\Laravel\Notification\Http\Controllers\Api\Admin;

use Exception;
use Illuminate\Http\Request;
use VCComponent\Laravel\Notification\Repositories\TemplateVariableRepository;
use VCComponent\Laravel\Notification\Transformers\TemplateVariableTransformer;
use VCComponent\Laravel\Notification\Validators\TemplateVariableValidator;
use VCComponent\Laravel\Vicoders\Core\Controllers\ApiController;

class TemplateVariableController extends ApiController {

    protected $repository;
    protected $entity;
    protected $validator;
    protected $transformer;

    public function __construct(TemplateVariableRepository $repository, TemplateVariableValidator $validator, TemplateVariableTransformer $transformer) 
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

        if (config('webpress-notification.transformers.template-variable')) {
            $this->transformer = config('webpress-notification.transformers.template-variable');
        } else {
            $this->transformer  = $transformer;
        }
    }

    public function index(Request $request) {
        $query = $this->entity;

        $query = $this->applyConstraintsFromRequest($query, $request);
        $query = $this->applySearchFromRequest($query, ['variable'], $request);
        $query = $this->applyOrderByFromRequest($query, $request);

        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        if ($request->has('page')) {
            $per_page = $request->has('per_page') ? (int) $request->get('per_page') : 15;
            $template_variables    = $query->paginate($per_page);
            
            return $this->response->paginator($template_variables, $transformer);
        }
        $template_variables = $query->get();
            
        return $this->response->collection($template_variables, $transformer);
    }

    public function show(Request $request, $id) {
        $template_variable = $this->repository->findById($id);

        if ($request->has('includes')) {
            $transformer = new $this->transformer(explode(',', $request->get('includes')));
        } else {
            $transformer = new $this->transformer;
        }

        return $this->response->item($template_variable, $transformer);
    }

    public function store(Request $request)
    {
        $this->validator->isValid($request, 'RULE_ADMIN_CREATE');

        $data = $request->all();

        $template_variable  = $this->repository->create($data);

        return $this->response->item($template_variable, new $this->transformer());
    }

    public function update(Request $request, $id)
    { 
        $template_variable = $this->repository->findById($id);

        $this->validator->isValid($request, 'RULE_ADMIN_UPDATE');

        $data = $request->all();

        $template_variable  = $this->repository->update($data, $id);

        return $this->response->item($template_variable, new $this->transformer());
    }

    public function destroy($id)
    {
        $notificatioin = $this->repository->findById($id);

        $this->repository->delete($id);

        return $this->success();
    }
}