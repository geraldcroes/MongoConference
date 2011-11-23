<?php
require __DIR__.'/../mongodb_odm/lib/vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';

use Doctrine\Common\ClassLoader,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\ODM\MongoDB\DocumentManager,
    Doctrine\MongoDB\Connection,
    Doctrine\ODM\MongoDB\Configuration,
    Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;

// ODM Classes
$classLoader = new ClassLoader('Doctrine\ODM\MongoDB', __DIR__.'/../mongodb_odm/lib');
$classLoader->register();

// Common Classes
$classLoader = new ClassLoader('Doctrine\Common', __DIR__.'/../mongodb_odm/lib/vendor/doctrine-common/lib');
$classLoader->register();

// MongoDB Classes
$classLoader = new ClassLoader('Doctrine\MongoDB', __DIR__.'/../mongodb_odm/lib/vendor/doctrine-mongodb/lib');
$classLoader->register();

$config = new Configuration();
$config->setProxyDir(__DIR__ . '/cache');
$config->setProxyNamespace('Proxies');

$config->setHydratorDir(__DIR__ . '/cache');
$config->setHydratorNamespace('Hydrators');

$reader = new AnnotationReader();
$reader->setDefaultAnnotationNamespace('Doctrine\ODM\MongoDB\Mapping\\');
$config->setMetadataDriverImpl(new AnnotationDriver($reader));

require __DIR__ . '/model.php';

$dm = DocumentManager::create(new Connection(), $config);