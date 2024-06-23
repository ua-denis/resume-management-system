<?php

namespace App\Application\Command\Resume;

class DeleteResumeCommand
{
    public int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}