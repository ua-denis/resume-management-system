<?php

namespace App\Application\EventHandler\Company;

use App\Domain\Event\Company\CompanyCreatedEvent;
use Psr\Log\LoggerInterface;

class CompanyCreatedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(CompanyCreatedEvent $event): void
    {
        $this->logger->info('Company created', ['company' => $event->getCompany()]);
    }
}