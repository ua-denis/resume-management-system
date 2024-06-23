<?php

namespace App\Contracts\Service;

use App\Application\Command\Company\CreateCompanyCommand;
use App\Application\Command\Company\DeleteCompanyCommand;
use App\Application\Command\Company\UpdateCompanyCommand;
use App\Application\Query\Company\GetCompanyByIdQuery;
use App\Domain\Model\Company;

interface CompanyServiceInterface
{
    public function createCompany(CreateCompanyCommand $command): Company;

    public function updateCompany(UpdateCompanyCommand $command): Company;

    public function deleteCompany(DeleteCompanyCommand $command): void;

    public function getCompanyById(GetCompanyByIdQuery $query): Company;
}