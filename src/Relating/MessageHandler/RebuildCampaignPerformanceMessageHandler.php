<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Message\RebuildCampaignPerformanceMessage;
use App\Relating\Service\CampaignPerformanceRebuilderInterface;
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
