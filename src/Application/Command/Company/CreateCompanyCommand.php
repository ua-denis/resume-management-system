<?php

namespace App\Application\Command\Company;

class CreateCompanyCommand
{
    public string $name;
    public string $website;
    public string $address;
    public string $telephone;

    public function __construct(string $name, string $website, string $address, string $telephone)
    {
        $this->name = $name;
        $this->website = $website;
        $this->address = $address;
        $this->telephone = $telephone;
    }
}