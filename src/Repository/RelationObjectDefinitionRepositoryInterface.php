<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationObjectDefinition;

interface RelationObjectDefinitionRepositoryInterface
{
    public function rememberPublished(RelationObjectDefinition $definition): void;

    public function definitionForCode(string $objectCode): ?RelationObjectDefinition;

    /** @return list<RelationObjectDefinition> */
    public function publishedDefinitions(): array;
}
