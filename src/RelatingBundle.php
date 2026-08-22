<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

final class RelatingBundle extends AbstractBundle
{
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services/relating.yaml.dist', 'yaml');
        $container->import('../config/services/relating_first_slice.yaml.dist', 'yaml');
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
