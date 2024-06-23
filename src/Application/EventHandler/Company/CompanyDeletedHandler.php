<?php

namespace App\Application\EventHandler\Company;

use App\Domain\Event\Company\CompanyDeletedEvent;
use Psr\Log\LoggerInterface;

class CompanyDeletedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(CompanyDeletedEvent $event): void
    {
        $this->logger->info('Company deleted', ['company' => $event->getCompany()]);
    }
}