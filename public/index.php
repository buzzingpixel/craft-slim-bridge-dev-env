<?php
/**
 * Craft web bootstrap file
 */

// Define path constants
define('CRAFT_BASE_PATH', dirname(__DIR__));
const CRAFT_VENDOR_PATH = CRAFT_BASE_PATH . '/vendor';

// Load Composer's autoloader
require_once CRAFT_VENDOR_PATH . '/autoload.php';

// Define additional PHP constants
// (see https://craftcms.com/docs/3.x/config/#php-constants)
define('CRAFT_ENVIRONMENT', getenv('ENVIRONMENT') ?: 'production');
// ...

if (class_exists(\Symfony\Component\VarDumper\VarDumper::class)) {
    require dirname(__DIR__) . '/config/dumper.php';
}

// Load and run Craft
/** @var craft\web\Application $app */
$app = require CRAFT_VENDOR_PATH . '/craftcms/cms/bootstrap/web.php';
$app->run();
