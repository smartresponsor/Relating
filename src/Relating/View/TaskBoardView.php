<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class TaskBoardView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'task.board';
    }

    public static function expectedKeys(): array
    {
        return ['ownerReference', 'columns', 'generatedAt'];
    }
}
