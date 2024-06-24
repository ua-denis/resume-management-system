<?php

namespace App\Application\EventHandler\Reaction;

use App\Domain\Event\Reaction\ReactionDeletedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ReactionDeletedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'reaction.deleted' => 'onReactionDeleted',
        ];
    }

    public function onReactionDeleted(ReactionDeletedEvent $event): void
    {
        $this->logger->info('Reaction deleted', ['reaction' => $event->getReaction()]);
    }
}