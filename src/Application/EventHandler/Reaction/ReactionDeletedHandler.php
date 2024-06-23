<?php

namespace App\Application\EventHandler\Reaction;

use App\Domain\Event\Reaction\ReactionDeletedEvent;
use Psr\Log\LoggerInterface;

class ReactionDeletedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ReactionDeletedEvent $event): void
    {
        $this->logger->info('Reaction deleted', ['reaction' => $event->getReaction()]);
    }
}