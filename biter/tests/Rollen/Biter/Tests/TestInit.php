<?php

namespace Rollen\Biter\Tests;

error_reporting(E_ALL | E_STRICT);

$loader = require __DIR__ . '/../../../../../vendor/autoload.php';

$loader->add('Rollen\\Biter\\Tests\\', __DIR__);

set_include_path(
        get_include_path() . PATH_SEPARATOR . 
        realpath(__DIR__ . '/../../../files'));
