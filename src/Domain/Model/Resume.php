<?php

namespace App\Domain\Model;

class Resume
{
    private int $id;
    private string $jobTitle;
    private ?string $resumeFile;
    private string $resumeText;

    public function __construct(string $jobTitle, ?string $resumeFile, string $resumeText)
    {
        $this->jobTitle = $jobTitle;
        $this->resumeFile = $resumeFile;
        $this->resumeText = $resumeText;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(string $jobTitle): void
    {
        $this->jobTitle = $jobTitle;
    }

    public function getResumeFile(): ?string
    {
        return $this->resumeFile;
    }

    public function setResumeFile(?string $resumeFile): void
    {
        $this->resumeFile = $resumeFile;
    }

    public function getResumeText(): string
    {
        return $this->resumeText;
    }

    public function setResumeText(string $resumeText): void
    {
        $this->resumeText = $resumeText;
    }
}