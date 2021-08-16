<?php 

namespace VCComponent\Laravel\Notification\Test\Unit\Notifications;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use stdClass;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\MailRegister;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class MailRegisterTest extends TestCase {

    private $email_subject = 'User Registed';

    private $email_template = '[vi] WEBPRESS 02 - user registered';

    /** @test */
    public function should_send_notify_via_channels() {
        $user = factory(User::class)->make();

        $notification = $this->NewMailRegister($user);

        $this->assertEquals([WebpressChannel::class],$notification->via($user));
    }
    
    /** @test */
    public function can_send_notification() {
        Notification::fake();

        Notification::assertNothingSent();

        $user = factory(User::class)->make();

        $notification = $this->NewMailRegister($user);

        $this->assertEquals($this->email_subject, $notification->toWebpress($user)->buildParams()['subject']);
        $this->assertEquals($this->email_template, $notification->toWebpress($user)->buildParams()['template_name']);

        $user->notify($notification);

         // Assert a notification was sent to the given users...
        Notification::assertSentTo(
            $user, MailRegister::class
        );
    }

    protected function NewMailRegister($user)
    {
        return new MailRegister(
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