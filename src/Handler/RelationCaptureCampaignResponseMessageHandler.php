<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationCaptureCampaignResponseMessage;
use App\Relating\Service\RelationCampaignResponseRecorderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationCaptureCampaignResponseMessageHandler
{
    public function __construct(private RelationCampaignResponseRecorderInterface $responses)
    {
    }

    public function __invoke(RelationCaptureCampaignResponseMessage $message): void
    {
        $this->responses->recordCampaignResponse(
            $message->targetReference,
            RelationBusinessMessagePayload::string($message->payload, 'relationshipReference'),
            RelationBusinessMessagePayload::string($message->payload, 'responseType', 'responded'),
            RelationBusinessMessagePayload::array($message->payload, 'payload'),
        );
    }
}
