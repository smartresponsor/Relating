<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Application\Command\QualifyLeadCommand;
use App\Relating\Application\Service\QualifyLeadApplicationService;
use App\Relating\Message\QualifyLeadMessage;
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
