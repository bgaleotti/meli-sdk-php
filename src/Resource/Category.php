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
use Meli\Resource\Category\Attribute;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Category extends Resource
{
    public function findById($id)
    {
        return $this->get("/categories/$id");
    }

    public function attributes($id)
    {
        return new Attribute($this->adapter, $id);
    }
}