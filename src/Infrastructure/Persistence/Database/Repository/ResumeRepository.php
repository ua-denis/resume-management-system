<?php

namespace App\Infrastructure\Persistence\Database\Repository;

use App\Contracts\Repository\ResumeRepositoryInterface;
use App\Domain\Model\Resume;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use RuntimeException;

class ResumeRepository extends ServiceEntityRepository implements ResumeRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resume::class);
    }

    public function save(Resume $resume): void
    {
        $this->_em->persist($resume);
        $this->_em->flush();
    }

    public function delete(Resume $resume): void
    {
        $this->_em->remove($resume);
        $this->_em->flush();
    }

    /**
     * @throws Exception
     */
    public function findById(int $id): Resume
    {
        $resume = $this->find($id);

        if (!$resume) {
            throw new RuntimeException('Resume not found');
        }

        return $resume;
    }

    public function findAll(): array
    {
        return $this->findBy([], ['jobTitle' => 'ASC']);
    }
}