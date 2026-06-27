# AI Review Trace

AI suggestions are traceable and reversible by design.

Allowed lifecycle:

```text
RaiseAiSuggestionMessage
AiSuggestionRaised
ReviewAiSuggestionMessage
AiReviewTrace
AiSuggestionAccepted | AiSuggestionRejected
ApplyAiSuggestionMessage
AiSuggestionApplied
```

AI does not directly mutate Relating state without a business trace and review decision.
