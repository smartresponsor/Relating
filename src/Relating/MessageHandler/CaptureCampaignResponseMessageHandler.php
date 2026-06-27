<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Message\CaptureCampaignResponseMessage;
use App\Relating\Service\CampaignResponseRecorderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CaptureCampaignResponseMessageHandler
{
    public function __construct(private CampaignResponseRecorderInterface $responses)
    {
    }

    public function __invoke(CaptureCampaignResponseMessage $message): void
    {
        $this->responses->recordCampaignResponse(
            $message->targetReference,
            BusinessMessagePayload::string($message->payload, 'relationshipReference'),
            BusinessMessagePayload::string($message->payload, 'responseType', 'responded'),
            BusinessMessagePayload::array($message->payload, 'payload'),
        );
    }
}
