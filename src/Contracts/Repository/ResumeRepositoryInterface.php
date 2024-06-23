<?php

namespace App\Contracts\Repository;

use App\Domain\Model\Resume;

interface ResumeRepositoryInterface
{
    public function save(Resume $resume): void;

    public function delete(Resume $resume): void;

    public function findById(int $id): Resume;

    public function findAll(): array;
}