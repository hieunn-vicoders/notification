<?php

namespace VCComponent\Laravel\Notification\Test\Feat\Api\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Notification;
use VCComponent\Laravel\Notification\Test\Stub\Entities\NotificationSetting;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Role;
use VCComponent\Laravel\Notification\Test\TestCase;

class NotificationSettingControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_get_notification_setting_of_role_by_admin()
    {
        $token = $this->loginToken();

        $role_id = factory(Role::class)->create()->id;

        $notification_settings = factory(NotificationSetting::class, 5)->create([
            'type' => 'roles',
            'notificationable_id' => $role_id,
        ]);
        
        $notification_settings = $notification_settings->filter(function ($notification_setting) use ($role_id) {
            return $notification_setting->notificationable_id == $role_id;
        })->toArray();

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/admin/notification-setting/role/'. $role_id);

        $response->assertSuccessful();
        $response->assertJson(['data' => $notification_settings]);
    }

    /** @test */
    public function should_not_get_notification_setting_of_role_without_role_by_admin()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function should_not_get_notification_setting_of_role_with_undefined_role_by_admin()
    {
        $this->assertTrue(true);
    }
    
    /** @test */
    public function can_sync_notification_settings_of_role_by_admin()
    {
        $token = $this->loginToken();

        $role_id = factory(Role::class)->create()->id;

        $notifications = factory(Notification::class, 5)->create();

        $email_enable_array = [];
        $mobile_enable_array = [];
        $web_enable_array = [];

        $notification_settings = $notifications->map(function($notification) use ($role_id, &$email_enable_array, &$mobile_enable_array, &$web_enable_array) {
            $email_enable = rand(0, 1);
            $mobile_enable = rand(0, 1);
            $web_enable = rand(0, 1);

            if ($email_enable || $mobile_enable || $web_enable) {
                if ($email_enable) array_push($email_enable_array, $notification->id);
                if ($mobile_enable) array_push($mobile_enable_array, $notification->id);
                if ($web_enable) array_push($web_enable_array, $notification->id);
    
                return factory(NotificationSetting::class)->make([
                    'type' => 'roles',
                    'notificationable_id' => $role_id,
                    'notification_id' => $notification->id,
                    'email_enable' => $email_enable,
                    'mobile_enable' => $mobile_enable,
                    'web_enable' => $web_enable,
                ]);
            }
        })->filter(function ($value) { return !is_null($value); })->toArray();

        $data = [
            'role_id' => $role_id,
            'email_template_ids' => $email_enable_array,
            'mobile_template_ids' => $mobile_enable_array,
            'web_template_ids' => $web_enable_array,
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', 'api/admin/notification-setting/sync', $data);

        $response->assertSuccessful();
        foreach ($notification_settings as $notification_setting) {
            $this->assertDatabaseHas( 'notification_settings',$notification_setting);
        }
    }
}