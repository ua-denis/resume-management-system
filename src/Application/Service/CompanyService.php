<?php

namespace App\Application\Service;

use App\Application\Command\Company\CreateCompanyCommand;
use App\Application\Command\Company\DeleteCompanyCommand;
use App\Application\Command\Company\UpdateCompanyCommand;
use App\Application\Query\Company\GetCompanyByIdQuery;
use App\Common\ValueObject\PhoneNumber;
use App\Contracts\Repository\CompanyRepositoryInterface;
use App\Contracts\Service\CompanyServiceInterface;
use App\Domain\Event\Company\CompanyCreatedEvent;
use App\Domain\Event\Company\CompanyDeletedEvent;
use App\Domain\Event\Company\CompanyUpdatedEvent;
use App\Domain\Model\Company;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class CompanyService implements CompanyServiceInterface
{
    private CompanyRepositoryInterface $repository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(CompanyRepositoryInterface $repository, EventDispatcherInterface $eventDispatcher)
    {
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createCompany(CreateCompanyCommand $command): Company
    {
        $telephone = new PhoneNumber($command->telephone);
        $company = new Company($command->name, $command->website, $command->address, $telephone);
        $this->repository->save($company);
        $this->eventDispatcher->dispatch(new CompanyCreatedEvent($company));
        
        return $company;
    }

    public function updateCompany(UpdateCompanyCommand $command): Company
    {
        $company = $this->repository->findById($command->id);
        $telephone = new PhoneNumber($command->telephone);
        $company->setName($command->name);
        $company->setWebsite($command->website);
        $company->setAddress($command->address);
        $company->setTelephone($telephone);
        $this->repository->save($company);
        $this->eventDispatcher->dispatch(new CompanyUpdatedEvent($company));

        return $company;
    }

    public function deleteCompany(DeleteCompanyCommand $command): void
    {
        $company = $this->repository->findById($command->id);
        $this->repository->delete($company);
        $this->eventDispatcher->dispatch(new CompanyDeletedEvent($company));
    }

    public function getCompanyById(GetCompanyByIdQuery $query): Company
    {
        return $this->repository->findById($query->id);
    }

    public function getAllCompanies(): array
    {
        return $this->repository->findAll();
    }
}