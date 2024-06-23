<?php

namespace App\Application\Command\Resume;

class UpdateResumeCommand
{
    public int $id;
    public string $jobTitle;
    public ?string $resumeFile;
    public string $resumeText;

    public function __construct(int $id, string $jobTitle, ?string $resumeFile, string $resumeText)
    {
        $this->id = $id;
        $this->jobTitle = $jobTitle;
        $this->resumeFile = $resumeFile;
        $this->resumeText = $resumeText;
    }
}