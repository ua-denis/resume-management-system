<?php

namespace App\Application\EventHandler\Resume;

use App\Domain\Event\Resume\ResumeDeletedEvent;
use Psr\Log\LoggerInterface;

class ResumeDeletedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ResumeDeletedEvent $event): void
    {
        $this->logger->info('Resume deleted', ['resume' => $event->getResume()]);
    }
}