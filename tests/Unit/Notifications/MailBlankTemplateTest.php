<?php 

namespace VCComponent\Laravel\Notification\Test\Unit\Notifications;

use Illuminate\Support\Facades\Notification;
use VCComponent\Laravel\Notification\Notifications\Channels\WebpressChannel;
use VCComponent\Laravel\Notification\Notifications\MailBlankTemplate;
use VCComponent\Laravel\Notification\Test\Stub\Entities\User;
use VCComponent\Laravel\Notification\Test\TestCase;

class MailBlankTemplateTest extends TestCase {

    private $email_subject = 'Blank Template';

    private $email_template = '[vi] WEBPRESS 06 - blank template';

    /** @test */
    public function should_send_notify_via_channels() {
        $user = factory(User::class)->make();

        $notification = $this->NewBlankTemplate();

        $this->assertEquals([WebpressChannel::class],$notification->via($user));
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