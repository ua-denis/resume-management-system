<?php

namespace App\Application\Command\Company;

class DeleteCompanyCommand
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}