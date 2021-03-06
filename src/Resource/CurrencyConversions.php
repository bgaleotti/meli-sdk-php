<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli\Resource;

use Meli\Resource;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class CurrencyConversions extends Resource
{
    public function search(string $from, string $to) : array
    {
        return $this->get("/currency_conversions/search?from=$from&to=$to");
    }
}
