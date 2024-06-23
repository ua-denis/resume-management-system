<?php

namespace App\Domain\Event\Reaction;

use App\Domain\Model\Reaction;

class ReactionUpdatedEvent
{
    private Reaction $reaction;

    public function __construct(Reaction $reaction)
    {
        $this->reaction = $reaction;
    }

    public function getReaction(): Reaction
    {
        return $this->reaction;
    }
}