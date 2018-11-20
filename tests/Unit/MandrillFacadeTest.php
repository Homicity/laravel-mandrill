<?php

namespace Homicity\MandrillMailable\Tests\Unit;

use Homicity\MandrillMailable\Facades\MandrillMessage;
use Homicity\MandrillMailable\Tests\TestCase;

class MandrillFacadeTest extends TestCase
{
    /** @test */
    public function it_returns_a_messages_class()
    {
        $this->assertInstanceOf(\Mandrill_Messages::class, MandrillMessage::getFacadeRoot());
    }
}