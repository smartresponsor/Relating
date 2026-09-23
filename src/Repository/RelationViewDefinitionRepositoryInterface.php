<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationViewDefinitionEntity;

interface RelationViewDefinitionRepositoryInterface
{
    public function rememberPublished(RelationViewDefinitionEntity $definition): void;

    public function viewForCode(string $viewCode): ?RelationViewDefinitionEntity;

    /** @return list<RelationViewDefinitionEntity> */
    public function publishedViewsForObject(string $objectCode): array;
}
