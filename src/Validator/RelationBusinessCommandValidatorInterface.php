<?php

declare(strict_types=1);

namespace App\Relating\Validator;

interface RelationBusinessCommandValidatorInterface
{
    public function validateBusinessCommand(object $command): RelationValidationResult;
}
