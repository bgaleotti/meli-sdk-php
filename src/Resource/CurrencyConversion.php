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
class CurrencyConversion extends Resource
{
    public function search($from, $to)
    {
        return $this->get("/currency_conversions/search?from=$from&to=$to");
    }
}
