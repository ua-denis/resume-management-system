<?php

namespace App\Infrastructure\EventDispatcher;

use App\Contracts\EventDispatcher\EventDispatcher;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventDispatcherAdapter implements EventDispatcher
{
    private EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch(object $event): void
    {
        $this->dispatcher->dispatch($event);
    }
}