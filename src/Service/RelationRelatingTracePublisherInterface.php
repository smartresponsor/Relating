<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\ValueObject\Trace\RelationBusinessDecisionTrace;

interface RelationRelatingTracePublisherInterface
{
    public function publishBusinessDecisionTrace(RelationBusinessDecisionTrace $trace): void;
}
