<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/application/entities/"), $isDevMode);
$conn = array(
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => 'zaraki',
    'dbname'   => 'siperpu_2',
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);