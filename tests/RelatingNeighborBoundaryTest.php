<?php

declare(strict_types=1);

namespace App\Relating\Tests;

use App\Relating\Enum\RelationNeighborComponent;
use App\Relating\Enum\RelationNeighborReferenceKind;
use App\Relating\ValueObject\RelationNeighborReference;
use App\Relating\ValueObject\RelationNeighborSignalEnvelope;
use PHPUnit\Framework\TestCase;

final class RelatingNeighborBoundaryTest extends TestCase
{
    public function testNeighborReferenceIsScalarAndSerializable(): void
    {
        $reference = new RelationNeighborReference(
            RelationNeighborComponent::Vendoring,
            RelationNeighborReferenceKind::Vendor,
            'vendor_123',
        );

        self::assertSame('vendoring:vendor:vendor_123', $reference->key());
        self::assertSame([
            'component' => 'vendoring',
            'kind' => 'vendor',
            'reference' => 'vendor_123',
        ], $reference->jsonSerialize());
    }

    public function testNeighborSignalEnvelopeRejectsCrudStyleSignalKind(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new RelationNeighborSignalEnvelope(
            RelationNeighborComponent::Ordering,
            'OrderCreated',
            'order_1',
            'relationship_1',
        );
    }

    public function testRelatingDoesNotDeclareNeighborEntities(): void
    {
        $entityPath = \dirname(__DIR__).'/src/Entity';
        $forbidden = [
            'Vendor.php',
            'Account.php',
            'Contact.php',
            'Product.php',
            'Order.php',
            'Payment.php',
            'Shipment.php',
            'Message.php',
            'Project.php',
            'Access.php',
        ];

        foreach ($forbidden as $file) {
            self::assertFileDoesNotExist($entityPath.'/'.$file, $file.' must stay owned by its neighbor component.');
        }
    }

    public function testNeighborReferenceKindsExposeCanonicalCodes(): void
    {
        self::assertContains('vendor', RelationNeighborReferenceKind::codes());
        self::assertContains('message_thread', RelationNeighborReferenceKind::codes());
        self::assertContains('shipment', RelationNeighborReferenceKind::codes());
    }
}
