<?php

namespace App\Domain\Event\Resume;

use App\Domain\Model\Resume;

class ResumeCreatedEvent
{
    private Resume $resume;

    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    public function getResume(): Resume
    {
        return $this->resume;
    }
}