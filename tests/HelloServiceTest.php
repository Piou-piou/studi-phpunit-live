<?php

namespace App\Tests;

use App\Service\HelloService;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class HelloServiceTest extends TestCase
{
    public static function helloNameProvider(): array
    {
        return [
            ['George', null, 'Hello George !'],
            ['Alice', null, 'Hello Alice !'],
            ['Alice', 'Merveille', 'Hello Alice Merveille !'],
            ['Alice', 'Dupont', 'Hello Alice Dupont !'],
        ];
    }

    public static function goodbyeNameProvider(): array
    {
        return [
            ['George', null, 'Goodbye George :)'],
            ['Alice', null, 'Goodbye Alice :)'],
            ['Alice', 'Merveille', 'Goodbye Alice Merveille :)'],
            ['Alice', 'Dupont', 'Goodbye Alice Dupont :)'],
        ];
    }

    #[DataProvider('helloNameProvider')]
    public function testHelloWithName(string $firstname, ?string $lastname, string $excepted)
    {
        $helloService = new HelloService();

        $this->assertSame($excepted, $helloService->hello($firstname, $lastname));
    }

    #[DataProvider('goodbyeNameProvider')]
    public function testGoodbyeWithName(string $firstname, ?string $lastname, string $excepted)
    {
        $helloService = new HelloService();

        $this->assertSame($excepted, $helloService->goodbye($firstname, $lastname));
    }
}
