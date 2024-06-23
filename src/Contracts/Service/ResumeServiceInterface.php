<?php

namespace App\Contracts\Service;

use App\Application\Command\Resume\CreateResumeCommand;
use App\Application\Command\Resume\DeleteResumeCommand;
use App\Application\Command\Resume\UpdateResumeCommand;
use App\Application\Query\Resume\GetResumeByIdQuery;
use App\Domain\Model\Resume;

interface ResumeServiceInterface
{
    public function createResume(CreateResumeCommand $command): Resume;

    public function updateResume(UpdateResumeCommand $command): Resume;

    public function deleteResume(DeleteResumeCommand $command): void;

    public function getResumeById(GetResumeByIdQuery $query): Resume;
}