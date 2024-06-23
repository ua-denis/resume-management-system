<?php

namespace App\Application\Command\Reaction;

class DeleteReactionCommand
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}