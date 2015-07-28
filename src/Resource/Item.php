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

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Item extends Resource
{
    public function findById($id)
    {
        return $this->get("/items/$id");
    }

    public function search($siteId, $query)
    {
        return $this->createPaginator("/sites/$siteId/search?q=".urlencode($query));
    }

    protected function createPaginatorAdapter($uri)
    {
        return new ItemAdapter($this->adapter, $uri);
    }
}
