<?php

namespace App\Application\Service;

use App\Contracts\Repository\ReactionRepositoryInterface;

class StatisticsService
{
    private ReactionRepositoryInterface $repository;

    public function __construct(ReactionRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function getMostPositiveRatedResume(): array {
        return $this->repository->findMostPositiveRatedResume();
    }
}