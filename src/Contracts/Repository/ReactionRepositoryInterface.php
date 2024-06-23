<?php

namespace App\Contracts\Repository;

use App\Domain\Model\Reaction;

interface ReactionRepositoryInterface
{
    public function save(Reaction $reaction): void;

    public function delete(Reaction $reaction): void;

    public function findById(int $id): Reaction;

    public function findAll(): array;
}