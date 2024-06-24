<?php

namespace App\Application\EventHandler\Resume;

use App\Domain\Event\Resume\ResumeUpdatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ResumeUpdatedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            'resume.updated' => 'onResumeUpdated',
        ];
    }

    public function onResumeUpdated(ResumeUpdatedEvent $event): void
    {
        $this->logger->info('Resume updated', ['resume' => $event->getResume()]);
    }
}