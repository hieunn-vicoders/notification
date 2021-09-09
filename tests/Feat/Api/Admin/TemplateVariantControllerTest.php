<?php

namespace VCComponent\Laravel\Notification\Test\Feat\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;
use VCComponent\Laravel\Notification\Test\Stub\Entities\TemplateVariable;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class TemplateVariableControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_get_list_all_template_variables_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $template_variables = factory(TemplateVariable::class, 5)->create();

        $template_variables = $template_variables->map(function ($template_variable) {
            unset($template_variable['created_at']);
            unset($template_variable['updated_at']);
            return $template_variable;
        })->toArray();

        $list_ids = array_column($template_variables, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variables);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variables');

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variables]);
    }

    /** @test */
    public function can_get_list_all_template_variables_with_constraints_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $template_variables = factory(TemplateVariable::class, 5)->create();
        $variable_constraints = $template_variables[0]->variable;
        $constraints = '{"variable":"' . $variable_constraints . '"}';

        $template_variables = $template_variables->filter(function ($template_variable) use ($variable_constraints) {
            unset($template_variable['created_at']);
            unset($template_variable['updated_at']);
            return $template_variable->variable == $variable_constraints;
        })->toArray();

        $list_ids = array_column($template_variables, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variables);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variables?constraints=' . $constraints);

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variables]);
    }

    /** @test */
    public function can_get_list_all_template_variables_with_search_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $template_variables = factory(TemplateVariable::class, 5)->create();
        $search = $template_variables[0]->variable;

        $template_variables = TemplateVariable::where('variable', 'like', $search)->get();

        $template_variables = $template_variables->map(function ($template_variable) {
            unset($template_variable->created_at);
            unset($template_variable->updated_at);
            return $template_variable;
        })->toArray();

        $list_ids = array_column($template_variables, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variables);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variables?search=' . $search);

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variables]);
    }

    /** @test */
    public function can_get_list_all_template_variables_with_order_by_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $template_variables = factory(TemplateVariable::class, 4)->create();

        $template_variables = $template_variables->map(function ($template_variable) {
            unset($template_variable->created_at);
            unset($template_variable->updated_at);
            return $template_variable;
        })->toArray();

        $list_ids = array_column($template_variables, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variables);

        $list_variables = array_column($template_variables, 'variable');
        array_multisort($list_variables, SORT_ASC, $template_variables);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variables?order_by={"variable":"ASC"}');

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variables]);
    }

    /** @test */
    public function can_get_list_template_variables_with_paginate_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $template_variables = factory(TemplateVariable::class, 4)->create();

        $template_variables = $template_variables->map(function ($template_variable) {
            unset($template_variable->created_at);
            unset($template_variable->updated_at);
            return $template_variable;
        })->toArray();

        $list_ids = array_column($template_variables, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variables);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variables?page=1');

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variables]);

        $this->assertResponsePagiated($response);
    }

    /** @test */
    public function can_get_a_template_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $template_variable = factory(TemplateVariable::class)->create()->toArray();

        unset($template_variable['created_at']);
        unset($template_variable['updated_at']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variables/' . $template_variable['id']);

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variable]);
    }

    /** @test */
    public function should_not_get_an_undefined_template_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variables/1');

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Template variable not found']);
    }

    /** @test */
    public function can_create_a_template_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $data = factory(TemplateVariable::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/template-variables', $data);

        $response->assertSuccessful();
        $response->assertJson(['data' => $data]);
    }

    /** @test */
    public function should_not_create_a_template_variable_without_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $data = factory(TemplateVariable::class)->make(['variable' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/template-variables', $data);

        $this->assertValidator($response, 'variable', 'The variable field is required.');
    }

    /** @test */
    public function should_not_create_a_template_variable_without_notification_id_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $data = factory(TemplateVariable::class)->make(['notification_id' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/template-variables', $data);

        $this->assertValidator($response, 'notification_id', 'The notification id field is required.');
    }

    /** @test */
    public function can_update_a_template_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $template_variable = factory(TemplateVariable::class)->create();

        $data = factory(TemplateVariable::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variables/' . $template_variable->id, $data);

        $response->assertSuccessful();
        $response->assertJson(['data' => $data]);
    }

    /** @test */
    public function should_not_update_undefine_template_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $data = factory(TemplateVariable::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variables/1', $data);

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Template variable not found']);
    }

    /** @test */
    public function should_not_update_template_variable_with_null_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $template_variable = factory(TemplateVariable::class)->create();

        $data = factory(TemplateVariable::class)->make(['variable' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variables/' . $template_variable->id, $data);

        $this->assertValidator($response, 'variable', 'The variable field is required.');
    }

    /** @test */
    public function should_not_update_template_variable_with_null_notification_id_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $template_variable = factory(TemplateVariable::class)->create();

        $data = factory(TemplateVariable::class)->make(['notification_id' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variables/' . $template_variable->id, $data);

        $this->assertValidator($response, 'notification_id', 'The notification id field is required.');
    }

    /** @test */
    public function can_delete_a_template_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $template_variable = factory(TemplateVariable::class)->create()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('DELETE', 'api/admin/template-variables/' . $template_variable['id']);

        $response->assertSuccessful();

        $this->assertDatabaseMissing('notifications', $template_variable);
    }

    /** @test */
    public function should_not_delete_an_undefine_template_variable_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('DELETE', 'api/admin/template-variables/1');

        // $response->assertStatus(400);

        $response->assertJson(['message' => 'Template variable not found']);
    }
}
