<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Message\RecalculateOpportunityForecastMessage;
use App\Relating\Service\OpportunityForecastRecalculatorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RecalculateOpportunityForecastMessageHandler
{
    public function __construct(private OpportunityForecastRecalculatorInterface $forecaster)
    {
    }

    public function __invoke(RecalculateOpportunityForecastMessage $message): void
    {
        $this->forecaster->recalculateOpportunityForecast(
            $message->targetReference,
            BusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
