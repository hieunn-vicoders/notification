<?php

namespace VCComponent\Laravel\Notification\Test\Feat\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\Notification\Test\Stub\Entities\TemplateVariant;
use VCComponent\Laravel\Notification\Test\TestCase;

class TemplateVariantControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_get_list_all_template_variants_by_admin()
    {
        $token = $this->loginToken();
        $template_variants = factory(TemplateVariant::class, 5)->create();

        $template_variants = $template_variants->map(function ($template_variant) {
            unset($template_variant['created_at']);
            unset($template_variant['updated_at']);
            return $template_variant;
        })->toArray();

        $list_ids = array_column($template_variants, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variants);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variants');

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variants]);
    }

    /** @test */
    public function can_get_list_all_template_variants_with_constraints_by_admin()
    {
        $token = $this->loginToken();
        $template_variants = factory(TemplateVariant::class, 5)->create();
        $variable_constraints = $template_variants[0]->variable;
        $constraints = '{"variable":"' . $variable_constraints . '"}';

        $template_variants = $template_variants->filter(function ($template_variant) use ($variable_constraints) {
            unset($template_variant['created_at']);
            unset($template_variant['updated_at']);
            return $template_variant->variable == $variable_constraints;
        })->toArray();

        $list_ids = array_column($template_variants, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variants);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variants?constraints=' . $constraints);

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variants]);
    }

    /** @test */
    public function can_get_list_all_template_variants_with_search_by_admin()
    {
        $token = $this->loginToken();
        $template_variants = factory(TemplateVariant::class, 5)->create();
        $search = $template_variants[0]->variable;

        $template_variants = TemplateVariant::where('variable', 'like', $search)->get();

        $template_variants = $template_variants->map(function ($template_variant) {
            unset($template_variant->created_at);
            unset($template_variant->updated_at);
            return $template_variant;
        })->toArray();

        $list_ids = array_column($template_variants, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variants);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variants?search=' . $search);

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variants]);
    }

    /** @test */
    public function can_get_list_all_template_variants_with_order_by_by_admin()
    {
        $token = $this->loginToken();
        $template_variants = factory(TemplateVariant::class, 4)->create();

        $template_variants = $template_variants->map(function ($template_variant) {
            unset($template_variant->created_at);
            unset($template_variant->updated_at);
            return $template_variant;
        })->toArray();

        $list_ids = array_column($template_variants, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variants);

        $list_variables = array_column($template_variants, 'variable');
        array_multisort($list_variables, SORT_ASC, $template_variants);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variants?order_by={"variable":"ASC"}');

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variants]);
    }

    /** @test */
    public function can_get_list_template_variants_with_paginate_by_admin()
    {
        $token = $this->loginToken();
        $template_variants = factory(TemplateVariant::class, 4)->create();

        $template_variants = $template_variants->map(function ($template_variant) {
            unset($template_variant->created_at);
            unset($template_variant->updated_at);
            return $template_variant;
        })->toArray();

        $list_ids = array_column($template_variants, 'id');
        array_multisort($list_ids, SORT_DESC, $template_variants);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variants?page=1');

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variants]);

        $this->assertResponsePagiated($response);
    }

    /** @test */
    public function can_get_a_template_variant_by_admin()
    {
        $token = $this->loginToken();
        $template_variant = factory(TemplateVariant::class)->create()->toArray();

        unset($template_variant['created_at']);
        unset($template_variant['updated_at']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variants/' . $template_variant['id']);

        $response->assertSuccessful();
        $response->assertJson(['data' => $template_variant]);
    }

    /** @test */
    public function should_not_get_an_undefined_template_variant_by_admin()
    {
        $token = $this->loginToken();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/template-variants/1');

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Template variant not found']);
    }

    /** @test */
    public function can_create_a_template_variant_by_admin()
    {
        $token = $this->loginToken();

        $data = factory(TemplateVariant::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/template-variants', $data);

        $response->assertSuccessful();
        $response->assertJson(['data' => $data]);
    }

    /** @test */
    public function should_not_create_a_template_variant_without_variable_by_admin()
    {
        $token = $this->loginToken();

        $data = factory(TemplateVariant::class)->make(['variable' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/template-variants', $data);

        $this->assertValidator($response, 'variable', 'The variable field is required.');
    }

    /** @test */
    public function should_not_create_a_template_variant_without_notification_id_by_admin()
    {
        $token = $this->loginToken();

        $data = factory(TemplateVariant::class)->make(['notification_id' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/template-variants', $data);

        $this->assertValidator($response, 'notification_id', 'The notification id field is required.');
    }

    /** @test */
    public function can_update_a_template_variant_by_admin()
    {
        $token = $this->loginToken();

        $template_variant = factory(TemplateVariant::class)->create();

        $data = factory(TemplateVariant::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variants/' . $template_variant->id, $data);

        $response->assertSuccessful();
        $response->assertJson(['data' => $data]);
    }

    /** @test */
    public function should_not_update_undefine_template_variant_by_admin()
    {
        $token = $this->loginToken();

        $data = factory(TemplateVariant::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variants/1', $data);

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Template variant not found']);
    }

    /** @test */
    public function should_not_update_template_variant_with_null_variable_by_admin()
    {
        $token = $this->loginToken();

        $template_variant = factory(TemplateVariant::class)->create();

        $data = factory(TemplateVariant::class)->make(['variable' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variants/' . $template_variant->id, $data);

        $this->assertValidator($response, 'variable', 'The variable field is required.');
    }

    /** @test */
    public function should_not_update_template_variant_with_null_notification_id_by_admin()
    {
        $token = $this->loginToken();

        $template_variant = factory(TemplateVariant::class)->create();

        $data = factory(TemplateVariant::class)->make(['notification_id' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/template-variants/' . $template_variant->id, $data);

        $this->assertValidator($response, 'notification_id', 'The notification id field is required.');
    }

    /** @test */
    public function can_delete_a_template_variant_by_admin()
    {
        $token = $this->loginToken();

        $template_variant = factory(TemplateVariant::class)->create()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('DELETE', 'api/admin/template-variants/' . $template_variant['id']);

        $response->assertSuccessful();

        $this->assertDatabaseMissing('notifications', $template_variant);
    }

    /** @test */
    public function should_not_delete_an_undefine_template_variant_by_admin()
    {
        $token = $this->loginToken();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('DELETE', 'api/admin/template-variants/1');

        $response->assertStatus(400);

        $response->assertJson(['message' => 'Template variant not found']);
    }
}
