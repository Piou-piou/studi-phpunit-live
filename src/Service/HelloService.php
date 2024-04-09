<?php

namespace App\Service;

class HelloService
{
    public function hello(string $firstname, ?string $lastname = null): string
    {
        $string = 'Hello '.$firstname;

        if (!$lastname) {
            return $string.' !';
        }

        return $string.' '.$lastname.' !';
    }

    public function goodbye(string $firstname, ?string $lastname): string
    {
        $string = 'Goodbye '.$firstname;

        if (!$lastname) {
            return $string.' :)';
        }

        return $string.' '.$lastname.' :)';
    }
}
