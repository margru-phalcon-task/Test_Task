<?php

$loader = new \Phalcon\Loader();

$loader->registerDirs([
    APP_PATH . $config->application->controllersDir,
    APP_PATH . $config->application->pluginsDir,
    APP_PATH . $config->application->libraryDir,
    APP_PATH . $config->application->modelsDir,
    APP_PATH . $config->application->formsDir,
])->register();

$loader->registerClasses(
    [
        'Services' => APP_PATH . 'app/Services.php',
    ]
);
