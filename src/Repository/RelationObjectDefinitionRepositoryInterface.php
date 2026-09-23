<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationObjectDefinitionEntity;

interface RelationObjectDefinitionRepositoryInterface
{
    public function rememberPublished(RelationObjectDefinitionEntity $definition): void;

    public function definitionForCode(string $objectCode): ?RelationObjectDefinitionEntity;

    /** @return list<RelationObjectDefinitionEntity> */
    public function publishedDefinitions(): array;
}
