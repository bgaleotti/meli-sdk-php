<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

$term  = isset($argv[1]) ? $argv[1] : 'iphone';
$limit = isset($argv[2]) ? (int) $argv[2] : 50;

$api = require __DIR__.'/bootstrap.php';

$echoItem = function ($item) {
    echo_style('green', $item['title'].PHP_EOL);
    echo_style('blue', '  * Price:     ').echo_style('yellow', $item['currency_id'].' '.$item['price'].PHP_EOL);
    echo_style('blue', '  * Quantity:  ').echo_style('yellow', $item['sold_quantity'].' sold / '.$item['available_quantity'].' available'.PHP_EOL);
    echo_style('blue', '  * Address:   ').echo_style('yellow', $item['address']['city_name'].', '.$item['address']['state_name'].PHP_EOL);
    echo_style('blue', '  * Permalink: ').echo_style('yellow', $item['permalink'].PHP_EOL);
};

$paginator = $api->items()->search('MLA', $term);
$paginator->setMaxPerPage($limit);

foreach ($paginator as $item) {
    $echoItem($item);
}

echo_style('white', sprintf('%d item(s) were found matching "%s"', count($paginator), $term).PHP_EOL);
