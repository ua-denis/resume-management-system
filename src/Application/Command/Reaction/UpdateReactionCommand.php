<?php

namespace App\Application\Command\Reaction;

class UpdateReactionCommand
{
    public int $id;
    public string $reactionType;

    public function __construct(int $id, string $reactionType)
    {
        $this->id = $id;
        $this->reactionType = $reactionType;
    }
}