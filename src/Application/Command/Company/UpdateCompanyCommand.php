<?php

namespace App\Application\Command\Company;

class UpdateCompanyCommand
{
    public int $id;
    public string $name;
    public string $website;
    public string $address;
    public string $telephone;

    public function __construct(int $id, string $name, string $website, string $address, string $telephone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->website = $website;
        $this->address = $address;
        $this->telephone = $telephone;
    }
}