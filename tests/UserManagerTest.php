<?php

namespace Tests;

use App\Service\UserManager;
use PHPUnit\Framework\TestCase;

class UserManagerTest extends TestCase
{
    public function testGetByUsernameForIneexisting()
    {
        $um = new UserManager();
        $user = $um->findByUSername('nope');

        $this->assertEmpty($user);
    }

    public function testGetByUsernameForExisting()
    {
        $um = new UserManager();
        $user = $um->findByUsername('a.pilloud');

        $excepted = [
            'firstname' => 'Anthony',
            'lastname' => 'Pilloud',
            'username' => 'a.pilloud',
        ];

        $this->assertSame($excepted, $user);
    }

    public function testUserIsAdmin(): void
    {
        $this->markTestIncomplete(
            'La migration permettant de gérer si un user est un admin n\'est pas encore implémentée.',
        );

        $user_admin = false;

        $this->assertSame(true, $user_admin);
    }
}
