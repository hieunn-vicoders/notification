<?php 

namespace VCComponent\Laravel\Notification\Test\Unit\Notifications;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\Notification as NotificationsNotification;
use VCComponent\Laravel\Notification\Test\Stub\Entities\Notification as EntitiesNotification;
use VCComponent\Laravel\Notification\Test\Stub\Entities\NotificationSetting;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class NotificationTest extends TestCase {

    use RefreshDatabase;

    private $email_subject = 'Blank Template';

    private $email_template = '[vi] WEBPRESS 06 - blank template';

    /** @test */
    public function should_send_notify_via_configed_channels() {
        $user = factory(User::class)->create();
        $notification = factory(EntitiesNotification::class)->create();

        $channels = [];

        $email_enable = rand(0, 1);
        $mobile_enable = rand(0, 1);
        $web_enable = rand(0, 1);

        if ($email_enable) array_push($channels, WebpressChannel::class);
        if ($mobile_enable) array_push($channels, 'mobile_channel');
        if ($web_enable) array_push($channels, 'web_channel');

        $notification_setting = factory(NotificationSetting::class)->create([
            'notification_id' => $notification->id,
            'notificationable_id' => $user->id,
            'type'  => 'users',
            'email_enable' => $email_enable,
            'mobile_enable' => $mobile_enable,
            'web_enable' => $web_enable,
        ]);
        $notification = new NotificationsNotification($notification, []);

        $this->assertEquals($channels,$notification->via($user));
    }
    
    /** @test */
    public function can_send_notification() {
        Notification::fake();

        Notification::assertNothingSent();

        $user = factory(User::class)->make();

        $notification = $this->NewBlankTemplate();

        $this->assertEquals($this->email_subject, $notification->toWebpress($user)->buildParams()['subject']);
        $this->assertEquals($this->email_template, $notification->toWebpress($user)->buildParams()['template_name']);

        $user->notify($notification);

         // Assert a notification was sent to the given users...
        Notification::assertSentTo(
            $user, MailBlankTemplate::class
        );
    }

    protected function NewBlankTemplate()
    {
        return new MailBlankTemplate(
            $this->email_subject,
            'your html content',
        );
    }
}