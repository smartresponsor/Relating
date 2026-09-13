<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\RebuildCampaignPerformanceMessage;
use App\Service\CampaignPerformanceRebuilderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RebuildCampaignPerformanceMessageHandler
{
    public function __construct(private CampaignPerformanceRebuilderInterface $rebuilder)
    {
    }

    public function __invoke(RebuildCampaignPerformanceMessage $message): void
    {
        $this->rebuilder->rebuildCampaignPerformance(
            $message->targetReference,
            BusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
