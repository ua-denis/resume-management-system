<?php

namespace App\Application\Command\Reaction;

use DateTime;

class CreateReactionCommand
{
    public int $resumeId;
    public int $companyId;
    public string $reactionType;
    public DateTime $sentDate;

    public function __construct(int $resumeId, int $companyId, string $reactionType, DateTime $sentDate)
    {
        $this->resumeId = $resumeId;
        $this->companyId = $companyId;
        $this->reactionType = $reactionType;
        $this->sentDate = $sentDate;
    }
}