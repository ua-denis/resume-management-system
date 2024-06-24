<?php

namespace App\Infrastructure\Persistence\Database\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Persistence\Database\Repository\ReactionRepository")
 */
class Reaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     */
    private int $resumeId;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     */
    private int $companyId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Choice({"positive", "negative"})
     */
    private string $reactionType;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotNull
     */
    private DateTime $sentDate;


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