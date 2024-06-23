<?php

namespace App\Application\EventHandler\Company;

use App\Domain\Event\Company\CompanyUpdatedEvent;
use Psr\Log\LoggerInterface;

class CompanyUpdatedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(CompanyUpdatedEvent $event): void
    {
        $this->logger->info('Company updated', ['company' => $event->getCompany()]);
    }
}