<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\Trace\RelationBusinessDecisionTrace;

interface RelationBusinessDecisionTraceRecorderInterface
{
    public function record(RelationBusinessDecisionTrace $trace): void;
}
