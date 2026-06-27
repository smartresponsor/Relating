<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\ViewDefinition;

interface ViewDefinitionRepositoryInterface
{
    public function rememberPublished(ViewDefinition $definition): void;

    public function viewForCode(string $viewCode): ?ViewDefinition;

    /** @return list<ViewDefinition> */
    public function publishedViewsForObject(string $objectCode): array;
}
