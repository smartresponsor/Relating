<?php

declare(strict_types=1);


namespace App\ReadModel;

use App\Enum\ProjectionStatus;
use App\Enum\ReadModelKind;

abstract readonly class AbstractRelatingReadModel implements RelatingReadModelInterface
{
    public function __construct(
        private ReadModelKind $kind,
        private string $reference,
        private ProjectionStatus $status = ProjectionStatus::Projected,
        private ?\DateTimeImmutable $projectedAt = null,
    ) {
        if (trim($this->reference) === '') {
            throw new \InvalidArgumentException('Read model reference cannot be empty.');
        }
    }

    public function kind(): ReadModelKind
    {
        return $this->kind;
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function projectedAt(): \DateTimeImmutable
    {
        return $this->projectedAt ?? new \DateTimeImmutable('@0');
    }

    public function status(): ProjectionStatus
    {
        return $this->status;
    }

    /**
     * @return array<string, mixed>
     */
    final public function jsonSerialize(): array
    {
        return $this->toPayload();
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    protected function withEnvelope(array $payload): array
    {
        $envelope = [
            'kind' => $this->kind->value,
            'reference' => $this->reference,
            'status' => $this->status->value,
            'projectedAt' => $this->projectedAt()->format(DATE_ATOM),
            'payload' => $payload,
        ];

        $this->assertNoObjectLeakage($envelope);

        return $envelope;
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function assertNoObjectLeakage(array $payload): void
    {
        foreach ($payload as $value) {
            if (is_array($value)) {
                $this->assertNoObjectLeakage($value);
                continue;
            }

            if (is_object($value)) {
                throw new \InvalidArgumentException('Relating read model payload must not expose objects.');
            }
        }
    }
}
