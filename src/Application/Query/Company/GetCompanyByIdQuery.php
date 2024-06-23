<?php

namespace App\Application\Query\Company;

class GetCompanyByIdQuery
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}