<?php

namespace Tests;

use App\Entity\Movie;
use App\Entity\User;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public static function userProvider(): array
    {
        return [
            ['George', 18, ['Deadpool', 'Batman'], 13],
            ['Alice', 15, [], 8.5],
            ['Laurence', 42, ['Deadpool', 'Batman', 'Superman', 'Spiderman']],
        ];
    }

    #[DataProvider('userProvider')]
    public function testUserConstructor(string $name, int $age, array $movies, ?float $average = null)
    {
        $user = new User($age, $name);

        $this->assertSame($name, $user->getName());
        $this->assertSame($age, $user->getAge());

        $this->assertEmpty($user->getFavoriteMovies());
    }

    #[DataProvider('userProvider')]
    public function testTellName(string $name, int $age, array $movies, ?float $average = null)
    {
        $user = new User($age, $name);

        $this->assertIsString($user->tellName());
        $this->assertStringContainsString($name, $user->tellName());
    }

    #[DataProvider('userProvider')]
    public function testTellAge(string $name, int $age, array $movies, ?float $average = null)
    {
        $user = new User($age, $name);

        $this->assertIsString($user->tellAge());
        $this->assertStringContainsString($age, $user->tellAge());
    }

    #[DataProvider('userProvider')]
    public function testAverage(string $name, int $age, array $movies, ?float $average = null)
    {
        if (!$average) {
            $this->markTestSkipped('No average given');
        }

        $user = new User($age, $name);

        $user->setAverageSchoolNote($average);

        $this->assertIsFloat($user->getAverageSchoolNote());
        $this->assertSame($average, $user->getAverageSchoolNote());
    }

    #[DataProvider('userProvider')]
    public function testAddAndRemoveFavoriteMovie(string $name, int $age, array $movies, ?float $average = null)
    {
        $user = new User($age, $name);
        $this->assertEmpty($user->getFavoriteMovies());

        if (0 === count($movies)) {
            $this->markTestSkipped('No movie given');
        }

        $entityMovies = [];

        foreach ($movies as $movie) {
            $movie = new Movie($movie);
            $entityMovies[] = $movie;

            $this->assertTrue($user->addFavoriteMovie($movie));
            $this->assertContains($movie, $user->getFavoriteMovies());
        }

        $this->assertCount(count($movies), $user->getFavoriteMovies());

        $counter = count($movies);
        foreach ($entityMovies as $movie) {
            $this->assertTrue($user->removeFavoriteMovie($movie));
            $counter--;
            $this->assertCount($counter, $user->getFavoriteMovies());
        }

        $this->assertEmpty($user->getFavoriteMovies());
    }

    public function testFailedRemoveFavoriteMovie()
    {
        $this->expectException(InvalidArgumentException::class);

        $movie = new Movie('Batman');

        $user = new User(18, 'John');
        $user->removeFavoriteMovie($movie);
    }
}
