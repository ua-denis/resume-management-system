<?php

namespace App\Infrastructure\Persistence\Database\Repository;

use App\Contracts\Repository\ReactionRepositoryInterface;
use App\Domain\Model\Reaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use RuntimeException;

class ReactionRepository extends ServiceEntityRepository implements ReactionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reaction::class);
    }

    public function save(Reaction $reaction): void
    {
        $this->_em->persist($reaction);
        $this->_em->flush();
    }

    public function delete(Reaction $reaction): void
    {
        $this->_em->remove($reaction);
        $this->_em->flush();
    }

    /**
     * @throws Exception
     */
    public function findById(int $id): Reaction
    {
        $reaction = $this->find($id);
        if (!$reaction) {
            throw new RuntimeException('Reaction not found');
        }
        return $reaction;
    }

    public function findAll(): array
    {
        return $this->findBy([], ['sentDate' => 'DESC']);
    }

    public function findMostPositiveRatedResume(): array
    {
        return $this->createQueryBuilder('r')
            ->select('r.resumeId, COUNT(r.id) as positiveCount')
            ->where('r.reactionType = :positive')
            ->setParameter('positive', 'positive')
            ->groupBy('r.resumeId')
            ->orderBy('positiveCount', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
}