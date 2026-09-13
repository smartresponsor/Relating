<?php

declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\SchemaValidator;

require dirname(__DIR__).'/vendor/autoload.php';

$root = dirname(__DIR__);
$entityPath = $root.'/src/Entity';

if (!is_dir($entityPath)) {
    fwrite(STDERR, "Relating entity directory is missing.\n");
    exit(1);
}

$config = ORMSetup::createAttributeMetadataConfiguration([$entityPath], true);
$config->setNamingStrategy(new UnderscoreNamingStrategy());
$config->enableNativeLazyObjects(true);
$connection = DriverManager::getConnection([
    'driver' => 'pdo_sqlite',
    'memory' => true,
], $config);
$entityManager = new EntityManager($connection, $config);

$metadata = $entityManager->getMetadataFactory()->getAllMetadata();
if ([] === $metadata) {
    fwrite(STDERR, "No Doctrine ORM metadata was discovered under src/Entity.\n");
    exit(1);
}

$mappingErrors = (new SchemaValidator($entityManager))->validateMapping();
if ([] !== $mappingErrors) {
    foreach ($mappingErrors as $class => $errors) {
        foreach ($errors as $error) {
            fwrite(STDERR, sprintf("%s: %s\n", $class, $error));
        }
    }
    exit(1);
}

$schemaSql = (new SchemaTool($entityManager))->getCreateSchemaSql($metadata);
if ([] === $schemaSql) {
    fwrite(STDERR, "Doctrine metadata produced no schema statements.\n");
    exit(1);
}

if (is_dir($root.'/migrations')) {
    fwrite(STDERR, "Relating must not own host-application migrations; remove component-local migrations.\n");
    exit(1);
}

fwrite(STDOUT, sprintf(
    "Doctrine parity OK: %d mapped entities, %d generated schema statements, host-owned migrations boundary preserved.\n",
    count($metadata),
    count($schemaSql),
));
