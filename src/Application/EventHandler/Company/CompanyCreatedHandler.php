<?php

namespace App\Application\EventHandler\Company;

use App\Domain\Event\Company\CompanyCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CompanyCreatedHandler implements EventSubscriberInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'company.created' => 'onCompanyCreated',
        ];
    }

    public function onCompanyCreated(CompanyCreatedEvent $event): void
    {
        $this->logger->info('Company created', ['company' => $event->getCompany()]);
    }
}