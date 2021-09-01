<?php

namespace VCComponent\Laravel\Notification\Test\Feat\Api\Frontend;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Facades\JWTAuth;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Notification;
use VCComponent\Laravel\Notification\Test\Stub\Entities\NotificationSetting;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Role;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class NotificationSettingControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_get_notification_setting_of_user_by_frontend()
    {
        $user = factory(User::class)->create();
        $token = JWTAuth::fromUser($user);

        $notification_settings = factory(NotificationSetting::class, 5)->create([
            'notificationable_type' => 'users',
            'notificationable_id' => $user->id,
        ])->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/notification-setting/');

        $response->assertJson(['data' => $notification_settings]);
    }

    /** @test */
    public function can_get_configable_notification_setting_of_user_by_frontend()
    {
        $user = factory(User::class)->create();
        $roles = factory(Role::class, 5)->create();

        foreach ($roles as $role) {
            $user->attachRole($role);
        }
        $token = JWTAuth::fromUser($user);

        $notification_settings = factory(NotificationSetting::class, 2)->create([
            'notificationable_type' => 'roles',
            'notificationable_id' => $roles[1]->id,
        ])->toArray();

        $list_ids = array_column($notification_settings, 'id');
        array_multisort($list_ids, SORT_DESC, $notification_settings);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/notification-setting/configable');

        $response->assertJson(['data' => $notification_settings]);
    }

    /** @test */
    public function cant_syn_notification_setting_of_user_by_frontend()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();

        $notifications = factory(Notification::class, 5)->create();
        $user->attachRole($role);
        $token = JWTAuth::fromUser($user);

        $email_enable_array = [];
        $mobile_enable_array = [];
        $web_enable_array = [];

        $notification_settings = $notifications->map(function($notification) use ($role, &$email_enable_array, &$mobile_enable_array, &$web_enable_array) {
            $email_enable = rand(0, 1);
            $mobile_enable = rand(0, 1);
            $web_enable = rand(0, 1);

            if ($email_enable || $mobile_enable || $web_enable) {
                if ($email_enable) array_push($email_enable_array, $notification->id);
                if ($mobile_enable) array_push($mobile_enable_array, $notification->id);
                if ($web_enable) array_push($web_enable_array, $notification->id);
    
                return factory(NotificationSetting::class)->make([
                    'notificationable_type' => 'users',
                    'notificationable_id' => $role->id,
                    'notification_id' => $notification->id,
                    'email_enable' => $email_enable,
                    'mobile_enable' => $mobile_enable,
                    'web_enable' => $web_enable,
                ]);
            }
        })->filter(function ($value) { return !is_null($value); })->toArray();

        $data = [
            'email_template_ids' => $email_enable_array,
            'mobile_template_ids' => $mobile_enable_array,
            'web_template_ids' => $web_enable_array,
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/notification-setting/sync', $data);

        $response->assertSuccessful();
        foreach ($notification_settings as $notification_setting) {
            $this->assertDatabaseHas( 'notification_settings',$notification_setting);
        }
    }
}
