<?php

namespace App\Application\EventHandler\Reaction;

use App\Domain\Event\Reaction\ReactionCreatedEvent;
use Psr\Log\LoggerInterface;

class ReactionCreatedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(ReactionCreatedEvent $event): void
    {
        $this->logger->info('Reaction created', ['reaction' => $event->getReaction()]);
    }
}