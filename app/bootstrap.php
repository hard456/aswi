<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

include __DIR__ . '/bootstrap-local.php';

// dev prostředí, kytičky, sluníčko, všechno hezky funguje
if ($env === 'dev')
{
    $configurator->setDebugMode(TRUE); // enable for your remote IP
    $configurator->enableTracy(__DIR__ . '/../log');
    $configurator->setTempDirectory(__DIR__ . '/../temp');
}

// CIV prostředí, hovna, sračky, jsou to prostě nejlepčí kucí
else
{
    $logDir = '/tmp/klinopis/log';
    $tempDir = '/tmp/klinopis/temp';

    if (!file_exists($logDir))
    {
        mkdir($logDir, 0700, TRUE);
    }

    if (!file_exists($tempDir))
    {
        mkdir($tempDir, 0700, TRUE);
    }

    $configurator->enableTracy($logDir);
    $configurator->setTempDirectory($tempDir);
}

$configurator->setTimeZone('Europe/Prague');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');
$configurator->addConfig(__DIR__ . '/config/config.local.neon');
$configurator->addConfig(__DIR__ . '/config/model.neon');
$configurator->addConfig(__DIR__ . '/config/components.neon');

$container = $configurator->createContainer();

return $container;
