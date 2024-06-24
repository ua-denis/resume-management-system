<?php

namespace App\Application\EventHandler\Company;

use App\Domain\Event\Company\CompanyUpdatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CompanyUpdatedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'company.updated' => 'onCompanyUpdated',
        ];
    }

    public function onCompanyUpdated(CompanyUpdatedEvent $event): void
    {
        $this->logger->info('Company updated', ['company' => $event->getCompany()]);
    }
}