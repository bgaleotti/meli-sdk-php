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

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Attribute extends Resource
{
    /**
     * @type string
     */
    protected $categoryId;

    /**
     * @param HttpMethodsClient $httpMethodsClient
     * @param string               $categoryId
     */
    public function __construct(HttpMethodsClient $httpMethodsClient, $categoryId)
    {
        parent::__construct($httpMethodsClient);
        $this->categoryId = $categoryId;
    }

    public function findAll()
    {
        return $this->createPaginator("/categories/{$this->categoryId}/attributes");
    }
}
