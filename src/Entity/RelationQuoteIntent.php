<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_quote_intent')]
class RelationQuoteIntent extends RelationAbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 36)]
    private string $opportunityReference;

    #[ORM\Column(type: 'string', length: 3)]
    private string $currency = 'USD';

    #[ORM\Column(type: 'integer')]
    private int $estimatedAmountMinor = 0;

    #[ORM\Column(type: 'json')]
    private array $terms = [];

    public function __construct(string $id, string $opportunityReference)
    {
        $this->bootEntity($id);
        $this->opportunityReference = $opportunityReference;
    }

    public function estimate(string $currency, int $estimatedAmountMinor, array $terms = []): void
    {
        if ($estimatedAmountMinor < 0) {
            throw new \InvalidArgumentException('Estimated amount cannot be negative.');
        }

        $this->currency = strtoupper($currency);
        $this->estimatedAmountMinor = $estimatedAmountMinor;
        $this->terms = $terms;
        $this->touch();
    }
}
