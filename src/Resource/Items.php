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

use Meli\Pagerfanta\Adapter\ItemAdapter;
use Meli\Resource;
use Pagerfanta\Pagerfanta;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Items extends Resource
{
    public function findById(string $id) : array
    {
        return $this->get("/items/$id");
    }

    public function search(string $siteId, string $query) : Pagerfanta
    {
        return $this->createPaginator("/sites/$siteId/search?q=".urlencode($query));
    }

    protected function createPaginator(string $uri) : Pagerfanta
    {
        return new Pagerfanta(new ItemAdapter($this->httpMethodsClient, $uri));
    }
}
