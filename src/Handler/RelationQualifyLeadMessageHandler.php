<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Command\RelationQualifyLeadCommand;
use App\Relating\Message\RelationQualifyLeadMessage;
use App\Relating\Service\Application\RelationQualifyLeadApplicationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationQualifyLeadMessageHandler
{
    public function __construct(private RelationQualifyLeadApplicationService $service)
    {
    }

    public function __invoke(RelationQualifyLeadMessage $message): void
    {
        $this->service->qualifyLead(new RelationQualifyLeadCommand(
            $message->targetReference,
            RelationBusinessMessagePayload::integer($message->payload, 'score', 50),
            RelationBusinessMessagePayload::string($message->payload, 'temperature', 'warm'),
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
