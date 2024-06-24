<?php

namespace App\Application\EventHandler\Company;

use App\Domain\Event\Company\CompanyDeletedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CompanyDeletedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'company.deleted' => 'onCompanyDeleted',
        ];
    }

    public function onCompanyDeleted(CompanyDeletedEvent $event): void
    {
        $this->logger->info('Company deleted', ['company' => $event->getCompany()]);
    }
}