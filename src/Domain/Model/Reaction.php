<?php

namespace App\Domain\Model;

use DateTime;

class Reaction
{
    private int $id;
    private int $resumeId;
    private int $companyId;
    private string $reactionType;
    private DateTime $sentDate;

    public function __construct(int $resumeId, int $companyId, string $reactionType, DateTime $sentDate)
    {
        $this->resumeId = $resumeId;
        $this->companyId = $companyId;
        $this->reactionType = $reactionType;
        $this->sentDate = $sentDate;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getResumeId(): int
    {
        return $this->resumeId;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getReactionType(): string
    {
        return $this->reactionType;
    }

    public function getSentDate(): DateTime
    {
        return $this->sentDate;
    }

    public function setResumeId(int $resumeId): void
    {
        $this->resumeId = $resumeId;
    }

    public function setCompanyId(int $companyId): void
    {
        $this->companyId = $companyId;
    }

    public function setReactionType(string $reactionType): void
    {
        $this->reactionType = $reactionType;
    }

    public function setSentDate(DateTime $sentDate): void
    {
        $this->sentDate = $sentDate;
    }
}