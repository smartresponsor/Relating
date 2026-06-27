<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Message\RecalculateCaseSlaMessage;
use App\Relating\Service\CaseSlaRecalculatorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RecalculateCaseSlaMessageHandler
{
    public function __construct(private CaseSlaRecalculatorInterface $recalculator)
    {
    }

    public function __invoke(RecalculateCaseSlaMessage $message): void
    {
        $this->recalculator->recalculateCaseSla(
            $message->targetReference,
            BusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
