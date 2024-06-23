<?php

namespace App\Application\Service;

use App\Application\Command\Resume\CreateResumeCommand;
use App\Application\Command\Resume\DeleteResumeCommand;
use App\Application\Command\Resume\UpdateResumeCommand;
use App\Application\Query\Resume\GetResumeByIdQuery;
use App\Contracts\Repository\ResumeRepositoryInterface;
use App\Contracts\Service\ResumeServiceInterface;
use App\Domain\Event\Resume\ResumeCreatedEvent;
use App\Domain\Event\Resume\ResumeDeletedEvent;
use App\Domain\Event\Resume\ResumeUpdatedEvent;
use App\Domain\Model\Resume;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ResumeService implements ResumeServiceInterface
{
    private ResumeRepositoryInterface $repository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(ResumeRepositoryInterface $repository, EventDispatcherInterface $eventDispatcher)
    {
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createResume(CreateResumeCommand $command): Resume
    {
        $resume = new Resume($command->jobTitle, $command->resumeFile, $command->resumeText);
        $this->repository->save($resume);
        $this->eventDispatcher->dispatch(new ResumeCreatedEvent($resume));
        
        return $resume;
    }

    public function updateResume(UpdateResumeCommand $command): Resume
    {
        $resume = $this->repository->findById($command->id);
        $resume->setJobTitle($command->jobTitle);
        $resume->setResumeFile($command->resumeFile);
        $resume->setResumeText($command->resumeText);
        $this->repository->save($resume);
        $this->eventDispatcher->dispatch(new ResumeUpdatedEvent($resume));

        return $resume;
    }

    public function deleteResume(DeleteResumeCommand $command): void
    {
        $resume = $this->repository->findById($command->id);
        $this->repository->delete($resume);
        $this->eventDispatcher->dispatch(new ResumeDeletedEvent($resume));
    }

    public function getResumeById(GetResumeByIdQuery $query): Resume
    {
        return $this->repository->findById($query->id);
    }

    public function getAllResumes(): array
    {
        return $this->repository->findAll();
    }
}