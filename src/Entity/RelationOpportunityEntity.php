<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use App\Relating\Enum\RelationForecastCategory;
use App\Relating\Enum\RelationOpportunityStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_opportunity')]
#[ORM\Index(columns: ['tenant_reference', 'relationship_reference'], name: 'idx_relating_opportunity_tenant_relationship')]
#[ORM\Index(columns: ['pipeline_reference'], name: 'idx_relating_opportunity_pipeline')]
#[ORM\Index(columns: ['stage_reference'], name: 'idx_relating_opportunity_stage')]
#[ORM\Index(columns: ['status'], name: 'idx_relating_opportunity_status')]
#[ORM\Index(columns: ['expected_close_date'], name: 'idx_relating_opportunity_close_date')]
final class RelationOpportunityEntity extends RelationAbstractRelatingEntity
{
    #[ORM\Column(type: 'string', length: 128)]
    private string $relationshipReference;

    #[ORM\Column(type: 'string', length: 128)]
    private string $pipelineReference;

    #[ORM\Column(type: 'string', length: 128)]
    private string $stageReference;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'string', length: 64)]
    private string $status;

    #[ORM\Column(type: 'string', length: 64)]
    private string $forecastCategory;

    #[ORM\Column(type: 'string', length: 3)]
    private string $currency = 'USD';

    #[ORM\Column(type: 'bigint')]
    private int $amountMinor = 0;

    #[ORM\Column(type: 'integer')]
    private int $probability = 0;

    #[ORM\Column(type: 'date_immutable', nullable: true)]
    private ?\DateTimeImmutable $expectedCloseDate = null;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $primaryProductReference = null;

    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    private ?string $lossReasonCode = null;

    #[ORM\Column(type: 'json')]
    private array $context = [];

    public function __construct(string $id, string $relationshipReference, string $pipelineReference, string $stageReference, string $name)
    {
        $this->bootEntity($id);
        $this->relationshipReference = $this->requiredText($relationshipReference, 'Relationship reference', 128);
        $this->pipelineReference = $this->requiredText($pipelineReference, 'RelationPipeline reference', 128);
        $this->stageReference = $this->requiredText($stageReference, 'Stage reference', 128);
        $this->name = $this->requiredText($name, 'RelationOpportunity name');
        $this->status = RelationOpportunityStatus::Open->value;
        $this->forecastCategory = RelationForecastCategory::Pipeline->value;
    }

    public function relationshipReference(): string
    {
        return $this->relationshipReference;
    }

    public function status(): string
    {
        return $this->status;
    }

    public function moveToStage(string $stageReference, int $probability, RelationForecastCategory $forecastCategory): void
    {
        $this->stageReference = $this->requiredText($stageReference, 'Stage reference', 128);
        $this->probability = $this->scoreValue($probability, 'RelationOpportunity probability');
        $this->forecastCategory = $forecastCategory->value;
        $this->touch();
    }

    public function setAmount(string $currency, int $amountMinor): void
    {
        $this->currency = $this->isoCurrency($currency);
        $this->amountMinor = $this->nonNegativeInt($amountMinor, 'Amount');
        $this->touch();
    }

    public function setPrimaryProductReference(?string $productReference): void
    {
        $this->primaryProductReference = $this->nullableText($productReference, 128);
        $this->touch();
    }

    public function scheduleClose(?\DateTimeImmutable $expectedCloseDate): void
    {
        $this->expectedCloseDate = $expectedCloseDate;
        $this->touch();
    }

    public function markWon(): void
    {
        $this->status = RelationOpportunityStatus::Won->value;
        $this->probability = 100;
        $this->forecastCategory = RelationForecastCategory::Closed->value;
        $this->lossReasonCode = null;
        $this->touch();
    }

    public function markLost(string $lossReasonCode): void
    {
        $this->status = RelationOpportunityStatus::Lost->value;
        $this->probability = 0;
        $this->forecastCategory = RelationForecastCategory::Omitted->value;
        $this->lossReasonCode = $this->requiredCode($lossReasonCode, 'Loss reason code', 128);
        $this->touch();
    }

    public function replaceContext(array $context): void
    {
        $this->context = $context;
        $this->touch();
    }
}
