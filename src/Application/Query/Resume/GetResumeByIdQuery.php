<?php

namespace App\Application\Query\Resume;

class GetResumeByIdQuery
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}