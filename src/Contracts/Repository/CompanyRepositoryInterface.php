<?php

namespace App\Contracts\Repository;

use App\Domain\Model\Company;

interface CompanyRepositoryInterface
{
    public function save(Company $company): void;

    public function delete(Company $company): void;

    public function findById(int $id): Company;

    public function findAll(): array;
}