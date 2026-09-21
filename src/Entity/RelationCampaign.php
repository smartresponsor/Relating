<?php

declare(strict_types=1);

namespace App\Relating\Entity;

use App\Relating\Enum\RelationCampaignChannel;
use App\Relating\Enum\RelationCampaignStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_campaign')]
#[ORM\Index(columns: ['tenant_reference', 'status'], name: 'idx_relating_campaign_tenant_status')]
#[ORM\Index(columns: ['channel'], name: 'idx_relating_campaign_channel')]
final class RelationCampaign extends RelationAbstractNamedRelatingEntity
{
    #[ORM\Column(type: 'string', length: 64)]
    private string $status = 'draft';

    #[ORM\Column(type: 'string', length: 64)]
    private string $channel = 'manual';

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $startsAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $endsAt = null;

    public function setChannel(RelationCampaignChannel $channel): void
    {
        $this->channel = $channel->value;
        $this->touch();
    }

    public function activate(?\DateTimeImmutable $startsAt = null): void
    {
        $this->status = RelationCampaignStatus::Active->value;
        $this->startsAt = $startsAt ?? new \DateTimeImmutable();
        $this->touch();
    }

    public function pause(): void
    {
        $this->status = RelationCampaignStatus::Paused->value;
        $this->touch();
    }

    public function complete(?\DateTimeImmutable $endsAt = null): void
    {
        $endsAt ??= new \DateTimeImmutable();
        if (null !== $this->startsAt) {
            $this->assertDateOrder($this->startsAt, $endsAt, 'RelationCampaign');
        }

        $this->status = RelationCampaignStatus::Completed->value;
        $this->endsAt = $endsAt;
        $this->touch();
    }
}
