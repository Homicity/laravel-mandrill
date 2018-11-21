<?php

namespace Homicity\MandrillMailable\Tests\Unit;

use Homicity\MandrillMailable\Facades\MandrillMessage;
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

//    /** @test */
//    public function it_sets_the_to_name()
//    {
//        $manMess = new MandrillMessage();
//        $manMess->name = "joe";
//
//        $this->assertTrue($manMess->name == "joe");
//    }

//    /** @test */
//    public function it_sets_the_template_name()
//    {
//        $manMess = new MandrillMessage();
//        $manMess->template = "testTemplate";
//
//        $this->assertTrue($manMess->template == "testTemplate");
//    }
//
//    /** @test */
//    public function it_sets_the_subject()
//    {
//        $manMess = new MandrillMessage();
//        $manMess->subject = "Subject";
//
//        $this->assertTrue($manMess->subject == "Subject");
//    }
//
//    /** @test */
//    public function it_sets_the_from_name()
//    {
//        $manMess = new MandrillMessage();
//        $manMess->fromName = "Dirt";
//
//        $this->assertTrue($manMess->fromName == "Dirt");
//    }
//
//    /** @test */
//    public function it_sets_the_from_email()
//    {
//        $manMess = new MandrillMessage();
//        $manMess->fromEmail = "test2@example.com";
//
//        $this->assertTrue($manMess->fromEmail == "test2@example.com");
//    }
}