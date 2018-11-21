<?php

namespace Homicity\MandrillMailable\Tests\Features;

use Homicity\MandrillMailable\Facades\MandrillMessage;
use Homicity\MandrillMailable\Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class SendMandrillTemplateTest extends TestCase
{
    /** @test */
    public function it_sends_a_mandrill_template()
    {
        MandrillMessage::shouldReceive('sendTemplate')->andReturn([['status' => 'sent']]);

        $response = Mail::mandrill()
            ->to('john@example.com')
            ->name('John Doe')
            ->templateName('template-name')
            ->fromEmail('no-reply@example.com')
            ->fromName('Example Website')
            ->subject('Hello Mandrill')
            ->send();

        $this->assertTrue($response[0]['status'] == 'sent');
    }
}