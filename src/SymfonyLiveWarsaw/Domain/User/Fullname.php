<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Domain\User;

final class Fullname
{
    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    private function __construct()
    {
    }

    public static function fromFirstAndLastName(string $firstName, string $lastName): Fullname
    {
        $fullname = new Fullname();
        $fullname->firstName = $firstName;
        $fullname->lastName = $lastName;

        return $fullname;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }
}
