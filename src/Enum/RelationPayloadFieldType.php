<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationPayloadFieldType: string
{
    case String = 'string';
    case Integer = 'integer';
    case Boolean = 'boolean';
    case Decimal = 'decimal';
    case DateTime = 'datetime';
    case Array = 'array';
    case Object = 'object';
    case Enum = 'enum';
    case Reference = 'reference';
}
