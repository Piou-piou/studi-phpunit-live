<?php

namespace App\Entity;

use InvalidArgumentException;

class User
{
    private int $age;
    private string $name;
    private array $favorite_movies = [];

    private float $averageSchoolNote;

    public function __construct(int $age, string $name)
    {
        $this->age = $age;
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAverageSchoolNote(): float
    {
        return $this->averageSchoolNote;
    }

    public function setAverageSchoolNote(float $averageSchoolNote): void
    {
        $this->averageSchoolNote = $averageSchoolNote;
    }

    public function getFavoriteMovies(): array
    {
        return $this->favorite_movies;
    }

    public function addFavoriteMovie(Movie $movie): bool
    {
        $this->favorite_movies[] = $movie;

        return true;
    }

    public function removeFavoriteMovie(Movie $movie): bool
    {
        if (!in_array($movie, $this->favorite_movies)) {
            throw new InvalidArgumentException("Unknown movie: " . $movie->getName());
        }

        unset($this->favorite_movies[array_search($movie, $this->favorite_movies)]);

        return true;
    }

    //custom methods

    public function tellName(): string
    {
        return "My name is " . $this->name . ".";
    }

    public function tellAge(): string
    {
        return "I am " . $this->age . " years old.";
    }
}
