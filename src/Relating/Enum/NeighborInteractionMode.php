<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum NeighborInteractionMode: string
{
    case ReferenceOnly = 'reference_only';
    case IncomingSignal = 'incoming_signal';
    case OutgoingBusinessRequest = 'outgoing_business_request';
    case ViewProjection = 'view_projection';
    case WorkflowTrigger = 'workflow_trigger';
    case AiSuggestionContext = 'ai_suggestion_context';
}
