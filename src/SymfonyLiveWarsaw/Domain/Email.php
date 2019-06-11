<?php

declare(strict_types=1);

namespace SymfonyLiveWarsaw\Domain;

use InvalidArgumentException;

class Email
{
    private const HTML5_PATTERN = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/';

    /**
     * @var string
     */
    private $value;

    private function __construct()
    {
    }

    public static function fromString(string $value): Email
    {
        if (!self::isValid($value)) {
            throw new InvalidArgumentException(
                sprintf('Value "%s" must match "%s" HTML5 regexp', $value, self::HTML5_PATTERN)
            );
        }

        $email = new Email();
        $email->value = $value;


        return $email;
    }

    public static function isValid(string $value): bool
    {
        if (!trim($value)) {
            return false;
        }

        $matched = preg_match(self::HTML5_PATTERN, $value);

        return $matched !== false && $matched > 0;
    }

    public function toString(): string
    {
        return mb_strtolower(trim($this->value));
    }

}
