<?php

namespace App\Contracts\EventDispatcher;

interface EventDispatcher
{
    public function dispatch(object $event): void;
}