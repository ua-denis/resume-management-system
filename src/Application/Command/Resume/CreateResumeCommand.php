<?php

namespace App\Application\Command\Resume;

class CreateResumeCommand
{
    public string $jobTitle;
    public ?string $resumeFile;
    public string $resumeText;

    public function __construct(string $jobTitle, ?string $resumeFile, string $resumeText)
    {
        $this->jobTitle = $jobTitle;
        $this->resumeFile = $resumeFile;
        $this->resumeText = $resumeText;
    }
}