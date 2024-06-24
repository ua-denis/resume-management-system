<?php

namespace App\Application\EventHandler\Reaction;

use App\Domain\Event\Reaction\ReactionCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReactionCreatedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'reaction.created' => 'onReactionCreated',
        ];
    }

    public function onReactionCreated(ReactionCreatedEvent $event): void
    {
        $this->logger->info('Reaction created', ['reaction' => $event->getReaction()]);
    }
}