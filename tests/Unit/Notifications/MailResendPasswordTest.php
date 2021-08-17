<?php 

namespace VCComponent\Laravel\Notification\Test\Unit\Notifications;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use stdClass;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\MailResendPassword;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class MailResendPasswordTest extends TestCase {

    private $email_subject = 'Resend Password';

    private $email_template = '[vi] WEBPRESS 05 - admin resend reset password';

    /** @test */
    public function should_send_notify_via_channels() {
        $user = factory(User::class)->make();

        $notification = $this->NewMailResendPassword($user);

        $this->assertEquals([WebpressChannel::class],$notification->via($user));
    }
    
    /** @test */
    public function can_send_notification() {
        Notification::fake();

        Notification::assertNothingSent();

        $user = factory(User::class)->make();

        $notification = $this->NewMailResendPassword($user);

        $this->assertEquals($this->email_subject, $notification->toWebpress($user)->buildParams()['subject']);
        $this->assertEquals($this->email_template, $notification->toWebpress($user)->buildParams()['template_name']);

        $user->notify($notification);

         // Assert a notification was sent to the given users...
        Notification::assertSentTo(
            $user, MailResendPassword::class
        );
    }

    protected function NewMailResendPassword($user)
    {
        return new MailResendPassword(
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
            'resend_password_url'
        );
    }
}