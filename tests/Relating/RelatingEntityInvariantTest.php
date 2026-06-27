<?php

declare(strict_types=1);

namespace App\Tests\Relating;

use App\Relating\Entity\Relationship;
use App\Relating\Enum\RelationshipKind;
use PHPUnit\Framework\TestCase;

final class RelatingEntityInvariantTest extends TestCase
{
    public function testRelationshipRequiresVendorReference(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Relationship('relationship-1', '   ', RelationshipKind::Prospect);
    }

    public function testRelationshipScoreMustStayInsideBusinessRange(): void
    {
        $relationship = new Relationship('relationship-1', 'vendor-1', RelationshipKind::Prospect);

        $this->expectException(\InvalidArgumentException::class);

        $relationship->updateScores(101, 50, 50);
    }
}
