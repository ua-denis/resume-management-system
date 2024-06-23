<?php

namespace App\Application\Service;

use App\Application\Command\Reaction\CreateReactionCommand;
use App\Application\Command\Reaction\DeleteReactionCommand;
use App\Application\Command\Reaction\UpdateReactionCommand;
use App\Application\Query\Reaction\GetReactionByIdQuery;
use App\Contracts\Repository\ReactionRepositoryInterface;
use App\Contracts\Service\ReactionServiceInterface;
use App\Domain\Event\Reaction\ReactionCreatedEvent;
use App\Domain\Event\Reaction\ReactionDeletedEvent;
use App\Domain\Event\Reaction\ReactionUpdatedEvent;
use App\Domain\Model\Reaction;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class ReactionService implements ReactionServiceInterface
{
    private ReactionRepositoryInterface $repository;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(ReactionRepositoryInterface $repository, EventDispatcherInterface $eventDispatcher)
    {
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function createReaction(CreateReactionCommand $command): Reaction
    {
        $reaction = new Reaction($command->resumeId, $command->companyId, $command->reactionType, $command->sentDate);
        $this->repository->save($reaction);
        $this->eventDispatcher->dispatch(new ReactionCreatedEvent($reaction));
        
        return $reaction;
    }

    public function updateReaction(UpdateReactionCommand $command): Reaction
    {
        $reaction = $this->repository->findById($command->id);
        $reaction->setReactionType($command->reactionType);
        $this->repository->save($reaction);
        $this->eventDispatcher->dispatch(new ReactionUpdatedEvent($reaction));

        return $reaction;
    }

    public function deleteReaction(DeleteReactionCommand $command): void
    {
        $reaction = $this->repository->findById($command->id);
        $this->repository->delete($reaction);
        $this->eventDispatcher->dispatch(new ReactionDeletedEvent($reaction));
    }

    public function getReactionById(GetReactionByIdQuery $query): Reaction
    {
        return $this->repository->findById($query->id);
    }

    public function getAllReactions(): array
    {
        return $this->repository->findAll();
    }
}