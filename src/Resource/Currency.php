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
use Pagerfanta\Pagerfanta;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Currency extends Resource
{
    public function findById(string $id) : array
    {
        return $this->get("/currencies/$id");
    }

    public function findAll() : Pagerfanta
    {
        return $this->createPaginator('/currencies');
    }
}
