<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$api = require __DIR__.'/bootstrap.php';

$echoCurrencyConversion = function ($from, $to) use ($api) {
    $currencyConversion = $api->currencyConversions()->search($from, $to);
    echo echo_style('green', sprintf('Currency conversion %s-%s', $from, $to)).PHP_EOL;
    echo echo_style('blue', '  * Ratio:             ').echo_style('yellow', $currencyConversion['ratio']).PHP_EOL;
    echo echo_style('blue', '  * MercadoPago ratio: ').echo_style('yellow', $currencyConversion['mercado_pago_ratio']).PHP_EOL;
};

$echoCurrencyConversion('ARS', 'USD');
$echoCurrencyConversion('USD', 'ARS');
