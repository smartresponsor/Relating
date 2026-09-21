<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationViewDefinition;

interface RelationViewDefinitionRepositoryInterface
{
    public function rememberPublished(RelationViewDefinition $definition): void;

    public function viewForCode(string $viewCode): ?RelationViewDefinition;

    /** @return list<RelationViewDefinition> */
    public function publishedViewsForObject(string $objectCode): array;
}
