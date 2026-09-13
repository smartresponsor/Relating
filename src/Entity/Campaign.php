<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\CampaignChannel;
use App\Enum\CampaignStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'relating_campaign')]
#[ORM\Index(columns: ['tenant_reference', 'status'], name: 'idx_relating_campaign_tenant_status')]
#[ORM\Index(columns: ['channel'], name: 'idx_relating_campaign_channel')]
final class Campaign extends AbstractNamedRelatingEntity
{
    #[ORM\Column(type: 'string', length: 64)]
    private string $status = 'draft';

    #[ORM\Column(type: 'string', length: 64)]
    private string $channel = 'manual';

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $startsAt = null;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private ?\DateTimeImmutable $endsAt = null;

    public function setChannel(CampaignChannel $channel): void
    {
        $this->channel = $channel->value;
        $this->touch();
    }

    public function activate(?\DateTimeImmutable $startsAt = null): void
    {
        $this->status = CampaignStatus::Active->value;
        $this->startsAt = $startsAt ?? new \DateTimeImmutable();
        $this->touch();
    }

    public function pause(): void
    {
        $this->status = CampaignStatus::Paused->value;
        $this->touch();
    }

    public function complete(?\DateTimeImmutable $endsAt = null): void
    {
        $endsAt ??= new \DateTimeImmutable();
        if (null !== $this->startsAt) {
            $this->assertDateOrder($this->startsAt, $endsAt, 'Campaign');
        }

        $this->status = CampaignStatus::Completed->value;
        $this->endsAt = $endsAt;
        $this->touch();
    }
}
