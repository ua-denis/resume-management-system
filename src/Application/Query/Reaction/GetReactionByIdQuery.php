<?php

namespace App\Application\Query\Reaction;

class GetReactionByIdQuery
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}