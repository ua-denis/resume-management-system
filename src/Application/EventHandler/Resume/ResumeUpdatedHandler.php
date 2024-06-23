<?php

namespace App\Application\EventHandler\Resume;

use App\Domain\Event\Resume\ResumeUpdatedEvent;
use Psr\Log\LoggerInterface;

class ResumeUpdatedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ResumeUpdatedEvent $event): void
    {
        $this->logger->info('Resume updated', ['resume' => $event->getResume()]);
    }
}