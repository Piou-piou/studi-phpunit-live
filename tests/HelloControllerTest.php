<?php

namespace App\Tests;

use App\Controller\HelloController;
use PHPUnit\Framework\TestCase;

class HelloControllerTest extends TestCase
{
    public function testHelloWithName(): void
    {
        $greeter = new HelloController();

        $greeting = $greeter->hello('Alice');

        $this->assertSame('Hello, Alice!', $greeting);
        $this->assertNotSame('Hello, George!', $greeting);
    }
}
