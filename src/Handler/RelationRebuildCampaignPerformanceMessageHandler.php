<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationRebuildCampaignPerformanceMessage;
use App\Relating\Service\RelationCampaignPerformanceRebuilderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationRebuildCampaignPerformanceMessageHandler
{
    public function __construct(private RelationCampaignPerformanceRebuilderInterface $rebuilder)
    {
    }

    public function __invoke(RelationRebuildCampaignPerformanceMessage $message): void
    {
        $this->rebuilder->rebuildCampaignPerformance(
            $message->targetReference,
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
