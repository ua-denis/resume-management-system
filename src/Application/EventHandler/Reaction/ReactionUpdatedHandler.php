<?php

namespace App\Application\EventHandler\Reaction;

use App\Domain\Event\Reaction\ReactionUpdatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReactionUpdatedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'reaction.updated' => 'onReactionUpdated',
        ];
    }

    public function onReactionUpdated(ReactionUpdatedEvent $event): void
    {
        $this->logger->info('Reaction updated', ['reaction' => $event->getReaction()]);
    }
}