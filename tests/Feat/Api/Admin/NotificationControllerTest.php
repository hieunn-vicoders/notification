<?php

namespace VCComponent\Laravel\Notification\Test\Feat\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Notification;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class NotificationControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_get_list_all_notifications_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $notifications = factory(Notification::class, 5)->create();

        $notifications = $notifications->map(function ($notification) {
            unset($notification['created_at']);
            unset($notification['updated_at']);
            return $notification;
        })->toArray();

        $list_ids = array_column($notifications, 'id');
        array_multisort($list_ids, SORT_DESC, $notifications);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notifications');

        $response->assertSuccessful();
        $response->assertJson(['data' => $notifications]);
    }

    /** @test */
    public function can_get_list_all_notifications_with_constraints_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $notifications = factory(Notification::class, 5)->create();
        $name_constraints = $notifications[0]->name;
        $constraints = '{"name":"' . $name_constraints . '"}';

        $notifications = $notifications->filter(function ($notification) use ($name_constraints) {
            unset($notification['created_at']);
            unset($notification['updated_at']);
            return $notification->name == $name_constraints;
        })->toArray();

        $list_ids = array_column($notifications, 'id');
        array_multisort($list_ids, SORT_DESC, $notifications);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notifications?constraints=' . $constraints);

        $response->assertSuccessful();
        $response->assertJson(['data' => $notifications]);
    }

    /** @test */
    public function can_get_list_all_notifications_with_search_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $notifications = factory(Notification::class, 5)->create();
        $search = $notifications[0]->name;

        $notifications = Notification::where('name', 'like', $search)->get();

        $notifications = $notifications->map(function ($notification) {
            unset($notification->created_at);
            unset($notification->updated_at);
            return $notification;
        })->toArray();

        $list_ids = array_column($notifications, 'id');
        array_multisort($list_ids, SORT_DESC, $notifications);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notifications?search=' . $search);

        $response->assertSuccessful();
        $response->assertJson(['data' => $notifications]);
    }

    /** @test */
    public function can_get_list_all_notifications_with_order_by_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $notifications = factory(Notification::class, 4)->create();

        $notifications = $notifications->map(function ($notification) {
            unset($notification->created_at);
            unset($notification->updated_at);
            return $notification;
        })->toArray();

        $list_ids = array_column($notifications, 'id');
        array_multisort($list_ids, SORT_DESC, $notifications);

        $list_names = array_column($notifications, 'name');
        array_multisort($list_names, SORT_ASC, $notifications);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notifications?order_by={"name":"ASC"}');

        $response->assertSuccessful();
        $response->assertJson(['data' => $notifications]);
    }

    /** @test */
    public function can_get_list_notifications_with_paginate_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $notifications = factory(Notification::class, 4)->create();

        $notifications = $notifications->map(function ($notification) {
            unset($notification->created_at);
            unset($notification->updated_at);
            return $notification;
        })->toArray();

        $list_ids = array_column($notifications, 'id');
        array_multisort($list_ids, SORT_DESC, $notifications);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notifications?page=1');

        $response->assertSuccessful();
        $response->assertJson(['data' => $notifications]);

        $this->assertResponsePagiated($response);
    }

    /** @test */
    public function can_get_a_notification_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);
        $notification = factory(Notification::class)->create()->toArray();

        unset($notification['created_at']);
        unset($notification['updated_at']);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notifications/' . $notification['id']);

        $response->assertSuccessful();
        $response->assertJson(['data' => $notification]);
    }

    /** @test */
    public function should_not_get_an_undefined_notification_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notifications/1');

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Notification not found']);
    }

    /** @test */
    public function can_create_a_notification_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $data = factory(Notification::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/notifications', $data);

        $response->assertSuccessful();
        $response->assertJson(['data' => $data]);
    }

    /** @test */
    public function should_not_create_a_notification_without_name_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $data = factory(Notification::class)->make(['name' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/notifications', $data);

        $this->assertValidator($response, 'name', 'The name field is required.');
    }

    /** @test */
    public function should_not_create_a_notification_with_duplicated_slug_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        factory(Notification::class)->create(['slug' => 'existed_slug']);

        $data = factory(Notification::class)->make(['slug' => 'existed_slug'])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', 'api/admin/notifications', $data);

        $this->assertValidator($response, 'slug', 'The slug has already been taken.');
    }

    /** @test */
    public function can_update_a_notification_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $notification = factory(Notification::class)->create();

        $data = factory(Notification::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/notifications/' . $notification->id, $data);

        $response->assertSuccessful();
        $response->assertJson(['data' => $data]);
    }

    /** @test */
    public function should_not_update_undefine_notification_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $data = factory(Notification::class)->make()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/notifications/1', $data);

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Notification not found']);
    }

    /** @test */
    public function should_not_update_notification_with_null_name_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $notification = factory(Notification::class)->create();

        $data = factory(Notification::class)->make(['name' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/notifications/' . $notification->id, $data);

        $this->assertValidator($response, 'name', 'The name field is required.');
    }

    /** @test */
    public function should_not_update_notification_with_null_slug_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $notification = factory(Notification::class)->create();

        $data = factory(Notification::class)->make(['slug' => null])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/notifications/' . $notification->id, $data);

        $this->assertValidator($response, 'slug', 'The slug field is required.');
    }

    /** @test */
    public function should_not_update_notification_with_duplicated_slug_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $notifications = factory(Notification::class, 2)->create();

        $data = factory(Notification::class)->make(['slug' => $notifications[1]->slug])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/notifications/' . $notifications[0]->id, $data);

        $this->assertValidator($response, 'slug', 'The slug has already been taken.');
    }

    /** @test */
    public function can_delete_a_notification_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $notification = factory(Notification::class)->create()->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('DELETE', 'api/admin/notifications/' . $notification['id']);

        $response->assertSuccessful();

        $this->assertDatabaseMissing('notifications', $notification);
    }

    /** @test */
    public function should_not_delete_an_undefine_notification_by_admin()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('DELETE', 'api/admin/notifications/1');

        $response->assertStatus(400);

        $response->assertJson(['message' => 'Notification not found']);
    }
}
