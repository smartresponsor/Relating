<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationRecalculateOpportunityForecastMessage;
use App\Relating\Service\RelationOpportunityForecastRecalculatorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationRecalculateOpportunityForecastMessageHandler
{
    public function __construct(private RelationOpportunityForecastRecalculatorInterface $forecaster)
    {
    }

    public function __invoke(RelationRecalculateOpportunityForecastMessage $message): void
    {
        $this->forecaster->recalculateOpportunityForecast(
            $message->targetReference,
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
