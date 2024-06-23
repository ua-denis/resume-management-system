<?php

namespace App\Infrastructure\Persistence\Database\Entity;

use App\Common\Trait\Timestampable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Persistence\Database\Repository\ResumeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Resume
{
    use Timestampable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     */
    private string $jobTitle;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $resumeFile;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private string $resumeText;
}