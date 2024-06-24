<?php

namespace App\Application\EventHandler\Resume;

use App\Domain\Event\Resume\ResumeCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ResumeCreatedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'resume.created' => 'onResumeCreated',
        ];
    }

    public function onResumeCreated(ResumeCreatedEvent $event): void
    {
        $this->logger->info('Resume created', ['resume' => $event->getResume()]);
    }
}