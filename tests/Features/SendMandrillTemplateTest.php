<?php

namespace Homicity\MandrillMailable\Tests\Features;

use Homicity\MandrillMailable\Tests\TestCase;
use Illuminate\Support\Facades\Mail;

class SendMandrillTemplateTest extends TestCase
{
    /** @test */
    public function it_sends_a_mandrill_template()
    {
        $response = Mail::mandrill()
            ->to('lyonelz@gmail.com')
            ->name('lyonel')
            ->template('email-request')
            ->subject('test')
            ->from('lyonel@homicity.com')
            ->fromName('Lyonel Homicity')
            ->send();

        $this->assertTrue($response[0]['status'] == 'sent');

        /**
         * TODO: Test with a mockery facade
         */
    }
}