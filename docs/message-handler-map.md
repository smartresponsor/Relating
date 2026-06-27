# S9 Message Handler Map

| Message | Handler | Boundary |
|---|---|---|
| QualifyLeadMessage | QualifyLeadMessageHandler | Lead lifecycle |
| ConvertLeadMessage | ConvertLeadMessageHandler | Lead-to-relationship lifecycle |
| TransitionOpportunityStageMessage | TransitionOpportunityStageMessageHandler | Opportunity lifecycle |
| DetectLeadDuplicateMessage | DetectLeadDuplicateMessageHandler | Duplicate review support |
| ScoreLeadMessage | ScoreLeadMessageHandler | Lead scoring support |
| BuildRelationshipTimelineMessage | BuildRelationshipTimelineMessageHandler | Relationship timeline read model |
| BuildTimelineMessage | BuildTimelineMessageHandler | Generic business timeline read model |
| RecalculateRelationshipHealthMessage | RecalculateRelationshipHealthMessageHandler | Relationship scoring |
| RecalculateOpportunityForecastMessage | RecalculateOpportunityForecastMessageHandler | Forecast read model |
| RecalculateOpportunityRiskMessage | RecalculateOpportunityRiskMessageHandler | Risk read model |
| RecalculateCaseSlaMessage | RecalculateCaseSlaMessageHandler | Case SLA read model |
| CaptureCampaignResponseMessage | CaptureCampaignResponseMessageHandler | Campaign response signal |
| RebuildCampaignPerformanceMessage | RebuildCampaignPerformanceMessageHandler | Campaign performance read model |
| RunRelatingAutomationMessage | RunRelatingAutomationMessageHandler | Business automation |
| RaiseAiSuggestionMessage | RaiseAiSuggestionMessageHandler | AI suggestion lifecycle |
| ReviewAiSuggestionMessage | ReviewAiSuggestionMessageHandler | AI review lifecycle |
| ApplyAiSuggestionMessage | ApplyAiSuggestionMessageHandler | AI application lifecycle |
