<?php

namespace App\Application\EventHandler\Resume;

use App\Domain\Event\Resume\ResumeDeletedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ResumeDeletedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'resume.deleted' => 'onResumeDeleted',
        ];
    }

    public function onResumeDeleted(ResumeDeletedEvent $event): void
    {
        $this->logger->info('Resume deleted', ['resume' => $event->getResume()]);
    }
}