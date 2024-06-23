<?php

namespace App\Application\EventHandler\Reaction;

use App\Domain\Event\Reaction\ReactionUpdatedEvent;
use Psr\Log\LoggerInterface;

class ReactionUpdatedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ReactionUpdatedEvent $event): void
    {
        $this->logger->info('Reaction updated', ['reaction' => $event->getReaction()]);
    }
}