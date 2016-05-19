<?php
define('APP_VENDOR_DIR', __DIR__.'/vendor');

$autoload = APP_VENDOR_DIR . '/autoload.php';
if (!is_dir(APP_VENDOR_DIR) || (is_dir(APP_VENDOR_DIR) && !file_exists($autoload))) {
    echo "No vendor libraries found: You need to run 'composer.phar install'.";
    exit(0);
}

/** @noinspection PhpIncludeInspection */
$loader = require_once $autoload;
return $loader;