<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationRecalculateCaseSlaMessage;
use App\Relating\Service\RelationCaseSlaRecalculatorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationRecalculateCaseSlaMessageHandler
{
    public function __construct(private RelationCaseSlaRecalculatorInterface $recalculator)
    {
    }

    public function __invoke(RelationRecalculateCaseSlaMessage $message): void
    {
        $this->recalculator->recalculateCaseSla(
            $message->targetReference,
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
