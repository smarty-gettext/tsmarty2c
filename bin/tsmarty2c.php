#!/usr/bin/env php
<?php

/*
 * This file is part of the smarty-gettext package.
 *
 * @copyright (c) Elan Ruusamäe
 * @license BSD
 * @see https://github.com/smarty-gettext/tsmarty2c
 *
 * For the full copyright and license information,
 * please see the LICENSE and AUTHORS files
 * that were distributed with this source code.
 */

use SmartyGettext\Console\Application;

/**
 * Attempts to load Composer's autoload.php as either a dependency or a
 * stand-alone package.
 *
 * @return boolean
 */
$loader = function () {
    $files = array(
        __DIR__ . '/../../../autoload.php',  // composer dependency
        __DIR__ . '/../vendor/autoload.php', // stand-alone package
    );
    foreach ($files as $file) {
        if (is_file($file)) {
            require_once $file;

            return true;
        }
    }

    return false;
};

if (!$loader()) {
    die(
        'You need to set up the project dependencies using the following commands:' . PHP_EOL .
        'curl -sS https://getcomposer.org/installer | php' . PHP_EOL .
        'php composer.phar install' . PHP_EOL
    );
}

$app = new Application('Smarty Gettext Translation String Ripper', '0.1.0');
$app->setDefaultCommand('extract', true);
$app->run();
