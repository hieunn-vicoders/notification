<?php 

namespace VCComponent\Laravel\Notification\Test\Unit\Notifications;

use Illuminate\Support\Facades\Notification;
use stdClass;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\MailResendVerify;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class MailResendVerifyTest extends TestCase {

    private $email_subject = 'Resend Verify';

    private $email_template = '[vi] WEBPRESS 04 - admin resend user verify email';

    /** @test */
    public function should_send_notify_via_channels() {
        $user = factory(User::class)->make();

        $notification = $this->NewMailResendVerify($user);

        $this->assertEquals([WebpressChannel::class],$notification->via($user));
    }
    
    /** @test */
    public function can_send_notification() {
        Notification::fake();

        Notification::assertNothingSent();

        $user = factory(User::class)->make();

        $notification = $this->NewMailResendVerify($user);

        $this->assertEquals($this->email_subject, $notification->toWebpress($user)->buildParams()['subject']);
        $this->assertEquals($this->email_template, $notification->toWebpress($user)->buildParams()['template_name']);

        $user->notify($notification);

         // Assert a notification was sent to the given users...
        Notification::assertSentTo(
            $user, MailResendVerify::class
        );
    }

    protected function NewMailResendVerify($user)
    {
        return new MailResendVerify(
            'logo.url.com',
            'facebook.com',
            'google.com',
            'twitter.com',
            '0987654321',
            'service_email.com',
            '#000000',
            '#dddddd',
            '#ffffff',
            $user->username,
            $user->email,
            'verify_url'
        );
    }
}