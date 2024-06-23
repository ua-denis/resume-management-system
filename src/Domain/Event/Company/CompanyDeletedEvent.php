<?php

namespace App\Domain\Event\Company;

use App\Domain\Model\Company;

class CompanyDeletedEvent
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }
}