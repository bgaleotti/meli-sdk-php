<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli\Resource\Category;

use Http\Client\Common\HttpMethodsClient;
use Meli\Resource;
use Pagerfanta\Pagerfanta;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Attribute extends Resource
{
    protected $categoryId;

    public function __construct(HttpMethodsClient $httpMethodsClient, string $categoryId)
    {
        parent::__construct($httpMethodsClient);
        $this->categoryId = $categoryId;
    }

    public function findAll() : Pagerfanta
    {
        return $this->createPaginator("/categories/{$this->categoryId}/attributes");
    }
}
