<?php

namespace App\Application\EventHandler\Resume;

use App\Domain\Event\Resume\ResumeCreatedEvent;
use Psr\Log\LoggerInterface;

class ResumeCreatedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ResumeCreatedEvent $event): void
    {
        $this->logger->info('Resume created', ['resume' => $event->getResume()]);
    }
}