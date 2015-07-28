<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'UTC');
}

if (PHP_SAPI !== 'cli') {
    die('Meli should be invoked via the CLI version of PHP, not the '.PHP_SAPI.' SAPI'.PHP_EOL);
}

if (!extension_loaded('curl')) {
    die('In order to use the Meli examples, curl extension must be enabled');
}

$files = [
    __DIR__.'/../vendor/autoload.php',
    __DIR__.'/../../../autoload.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $loader = require $file;
        define('MELI_COMPOSER_INSTALL', $file);
        break;
    }
}

if (!defined('MELI_COMPOSER_INSTALL')) {
    die(
        'You need to set up the project dependencies using the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL
    );
}

set_exception_handler(function ($ex) {
    echo_style('red', $ex->getMessage().PHP_EOL);
    exit(1);
});

// Borrow from https://github.com/symfony/symfony-standard/blob/master/app/check.php
function echo_style($style, $message)
{
    // ANSI color codes
    $styles = [
        'reset'   => "\033[0m",
        'red'     => "\033[31m",
        'green'   => "\033[32m",
        'yellow'  => "\033[33m",
        'blue'    => "\033[34m",
        'white'   => "\033[37m",
        'error'   => "\033[37;41m",
        'success' => "\033[37;42m",
        'title'   => "\033[34m",
    ];
    $supports = has_color_support();
    echo($supports ? $styles[$style] : '').$message.($supports ? $styles['reset'] : '');
}

function has_color_support()
{
    static $support;
    if (null === $support) {
        if (DIRECTORY_SEPARATOR === '\\') {
            $support = false !== getenv('ANSICON') || 'ON' === getenv('ConEmuANSI');
        } else {
            $support = function_exists('posix_isatty') && @posix_isatty(STDOUT);
        }
    }

    return $support;
}

return new \Meli\Api(new \Ivory\HttpAdapter\CurlHttpAdapter());
