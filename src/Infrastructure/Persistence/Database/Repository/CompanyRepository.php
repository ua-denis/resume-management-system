<?php

namespace App\Infrastructure\Persistence\Database\Repository;

use App\Contracts\Repository\CompanyRepositoryInterface;
use App\Domain\Model\Company;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use RuntimeException;

class CompanyRepository extends ServiceEntityRepository implements CompanyRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Company::class);
    }

    public function save(Company $company): void
    {
        $this->_em->persist($company);
        $this->_em->flush();
    }

    public function delete(Company $company): void
    {
        $this->_em->remove($company);
        $this->_em->flush();
    }

    /**
     * @throws Exception
     */
    public function findById(int $id): Company
    {
        $company = $this->find($id);
        if (!$company) {
            throw new RuntimeException('Company not found');
        }
        return $company;
    }

    public function findAll(): array
    {
        return $this->findBy([], ['name' => 'ASC']);
    }
}