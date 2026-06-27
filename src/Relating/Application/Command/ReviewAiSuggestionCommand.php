<?php

declare(strict_types=1);

namespace App\Relating\Application\Command;

final readonly class ReviewAiSuggestionCommand
{
    public function __construct(
        public string $suggestionReference,
        public string $reviewerReference,
        public string $decision,
        public ?string $reason = null,
        public array $context = [],
    ) {
        if (trim($this->suggestionReference) === '') {
            throw new \InvalidArgumentException('Suggestion reference cannot be empty.');
        }

        if (trim($this->reviewerReference) === '') {
            throw new \InvalidArgumentException('Reviewer reference cannot be empty.');
        }
    }
}
