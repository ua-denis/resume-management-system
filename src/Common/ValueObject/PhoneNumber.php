<?php

namespace App\Common\ValueObject;

use InvalidArgumentException;

class PhoneNumber
{
    private string $number;

    public function __construct(string $number)
    {
        if (!preg_match('/^\+?[1-9]\d{1,14}$/', $number)) {
            throw new InvalidArgumentException('Invalid phone number format');
        }
        $this->number = $number;
    }

    public function __toString(): string
    {
        return $this->number;
    }
}