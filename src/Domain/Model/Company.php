<?php

namespace App\Domain\Model;

use App\Common\ValueObject\PhoneNumber;

class Company
{
    private int $id;
    private string $name;
    private string $website;
    private string $address;
    private PhoneNumber $telephone;

    public function __construct(string $name, string $website, string $address, PhoneNumber $telephone)
    {
        $this->name = $name;
        $this->website = $website;
        $this->address = $address;
        $this->telephone = $telephone;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getTelephone(): PhoneNumber
    {
        return $this->telephone;
    }

    public function setTelephone(PhoneNumber $telephone): void
    {
        $this->telephone = $telephone;
    }
}