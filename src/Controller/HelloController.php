<?php

namespace App\Controller;

class HelloController
{
    public function hello(string $name): string
    {
        return 'Hello, ' . $name . '!';
    }
}
