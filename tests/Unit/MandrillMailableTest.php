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
        $mailer->to("john@example.com");

        $this->assertTrue($mailer->message['to']['email'] == "john@example.com");
    }

    /** @test */
    public function it_sets_the_to_name()
    {
        $mailer = new MandrillMailer();
        $mailer->name("John Doe");

        $this->assertTrue($mailer->message['to']['name'] == "John Doe");
    }

    /** @test */
    public function it_sets_the_template_name()
    {
        $mailer = new MandrillMailer();
        $mailer->templateName("Template name");

        $this->assertTrue($mailer->templateName == "Template name");
    }

    /** @test */
    public function it_sets_the_subject()
    {
        $mailer = new MandrillMailer();
        $mailer->subject("Hello World");

        $this->assertTrue($mailer->message['subject'] == "Hello World");
    }

    /** @test */
    public function it_sets_the_from_name()
    {
        $mailer = new MandrillMailer();
        $mailer->fromName("My Awesome Website");

        $this->assertTrue($mailer->message['from_name'] == "My Awesome Website");
    }

    /** @test */
    public function it_sets_the_from_email()
    {
        $mailer = new MandrillMailer();
        $mailer->fromEmail("no-reply@example.com");

        $this->assertTrue($mailer->message['from_email'] == "no-reply@example.com");
    }
}