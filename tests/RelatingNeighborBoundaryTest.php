<?php

declare(strict_types=1);

namespace App\Tests;

use App\Enum\NeighborComponent;
use App\Enum\NeighborReferenceKind;
use App\Value\NeighborReference;
use App\Value\NeighborSignalEnvelope;
use PHPUnit\Framework\TestCase;

final class RelatingNeighborBoundaryTest extends TestCase
{
    public function testNeighborReferenceIsScalarAndSerializable(): void
    {
        $reference = new NeighborReference(
            NeighborComponent::Vendoring,
            NeighborReferenceKind::Vendor,
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

        new NeighborSignalEnvelope(
            NeighborComponent::Ordering,
            'OrderCreated',
            'order_1',
            'relationship_1',
        );
    }

    public function testRelatingDoesNotDeclareNeighborEntities(): void
    {
        $entityPath = dirname(__DIR__).'/src/Entity';
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
        self::assertContains('vendor', NeighborReferenceKind::codes());
        self::assertContains('message_thread', NeighborReferenceKind::codes());
        self::assertContains('shipment', NeighborReferenceKind::codes());
    }
}
