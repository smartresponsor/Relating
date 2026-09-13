<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\RecalculateCaseSlaMessage;
use App\Service\CaseSlaRecalculatorInterface;
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
