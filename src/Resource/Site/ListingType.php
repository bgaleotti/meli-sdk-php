<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli\Resource\Site;

use Http\Client\Common\HttpMethodsClient;
use Meli\Resource;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ListingType extends Resource
{
    /**
     * @type string
     */
    protected $siteId;

    /**
     * @param HttpMethodsClient $httpMethodsClient
     * @param string               $siteId
     */
    public function __construct(HttpMethodsClient $httpMethodsClient, $siteId)
    {
        parent::__construct($httpMethodsClient);
        $this->siteId = $siteId;
    }

    public function findAll()
    {
        return $this->createPaginator("/sites/{$this->siteId}/listing_types");
    }

    protected function getModelClassName()
    {
        return \Meli\Model\Site\ListingType::class;
    }
}
