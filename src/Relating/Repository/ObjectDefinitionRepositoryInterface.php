<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\ObjectDefinition;

interface ObjectDefinitionRepositoryInterface
{
    public function rememberPublished(ObjectDefinition $definition): void;

    public function definitionForCode(string $objectCode): ?ObjectDefinition;

    /** @return list<ObjectDefinition> */
    public function publishedDefinitions(): array;
}
