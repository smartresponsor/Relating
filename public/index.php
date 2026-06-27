<?php

declare(strict_types=1);

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return static function (array $context): Kernel {
    $environment = (string) ($context['APP_ENV'] ?? 'dev');
    $debug = filter_var($context['APP_DEBUG'] ?? true, FILTER_VALIDATE_BOOL);

    return new Kernel($environment, $debug);
};
