<?php

namespace App\Contracts\Service;

use App\Application\Command\Reaction\CreateReactionCommand;
use App\Application\Command\Reaction\DeleteReactionCommand;
use App\Application\Command\Reaction\UpdateReactionCommand;
use App\Application\Query\Reaction\GetReactionByIdQuery;
use App\Domain\Model\Reaction;

interface ReactionServiceInterface
{
    public function createReaction(CreateReactionCommand $command): Reaction;

    public function updateReaction(UpdateReactionCommand $command): Reaction;

    public function deleteReaction(DeleteReactionCommand $command): void;

    public function getReactionById(GetReactionByIdQuery $query): Reaction;
}