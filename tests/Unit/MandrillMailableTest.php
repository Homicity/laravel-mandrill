<?php

namespace Homicity\MandrillMailable\Tests\Unit;

use Homicity\MandrillMailable\MandrillMailer;
use Homicity\MandrillMailable\Tests\TestCase;

class MandrillMailableTest extends TestCase
{
    /** @test */
    public function it_sets_the_to_email()
    {
        $mailer = new MandrillMailer();
        $mailer->to("test@example.com");

        $this->assertTrue($mailer->message['to']['email'] == "test@example.com");
    }

    /** @test */
    public function it_sets_the_to_name()
    {
        $mailer = new MandrillMailer();
        $mailer->name("joe");

        $this->assertTrue($mailer->message['to']['name'] == "joe");
    }

    /** @test */
    public function it_sets_the_template_name()
    {
        $mailer = new MandrillMailer();
        $mailer->templateName("test-template");

        $this->assertTrue($mailer->templateName == "test-template");
    }

    /** @test */
    public function it_sets_the_subject()
    {
        $mailer = new MandrillMailer();
        $mailer->subject("test-subject");

        $this->assertTrue($mailer->message['subject'] == "test-subject");
    }

    /** @test */
    public function it_sets_the_from_name()
    {
        $mailer = new MandrillMailer();
        $mailer->fromName("dirt");

        $this->assertTrue($mailer->message['from_name'] == "dirt");
    }

    /** @test */
    public function it_sets_the_from_email()
    {
        $mailer = new MandrillMailer();
        $mailer->fromEmail("dirt@email.com");

        $this->assertTrue($mailer->message['from_email'] == "dirt@email.com");
    }
}