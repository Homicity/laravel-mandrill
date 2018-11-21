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
            ->to('lyonelz@gmail.com')
            ->name('lyonel')
            ->template('email-request')
            ->subject('test')
            ->from('lyonel@homicity.com')
            ->fromName('Lyonel Homicity')
            ->send();

        $this->assertTrue($response[0]['status'] == 'sent');
    }
}