<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Application\Command\QualifyLeadCommand;
use App\Application\Service\QualifyLeadApplicationService;
use App\Message\QualifyLeadMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class QualifyLeadMessageHandler
{
    public function __construct(private QualifyLeadApplicationService $service)
    {
    }

    public function __invoke(QualifyLeadMessage $message): void
    {
        $this->service->qualifyLead(new QualifyLeadCommand(
            $message->targetReference,
            BusinessMessagePayload::integer($message->payload, 'score', 50),
            BusinessMessagePayload::string($message->payload, 'temperature', 'warm'),
            BusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
