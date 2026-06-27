<?php

declare(strict_types=1);


namespace App\Relating\Enum;

enum FieldType: string
{
    case Text = 'text';
    case Textarea = 'textarea';
    case Email = 'email';
    case Phone = 'phone';
    case Url = 'url';
    case Number = 'number';
    case Money = 'money';
    case Boolean = 'boolean';
    case Date = 'date';
    case DateTime = 'datetime';
    case Select = 'select';
    case MultiSelect = 'multi_select';
    case Reference = 'reference';
    case Json = 'json';
}
