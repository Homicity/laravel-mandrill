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
            ->to('test@test.com')
            ->name('Testing')
            ->templateName('test-template')
            ->fromEmail('test2@test.com')
            ->fromName('Testing From')
            ->subject('Testing')
            ->send();

        $this->assertTrue($response[0]['status'] == 'sent');
    }
}