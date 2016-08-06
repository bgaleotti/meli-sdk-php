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
use Pagerfanta\Pagerfanta;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ListingPrices extends Resource
{
    protected $siteId;

    public function __construct(HttpMethodsClient $httpMethodsClient, string $siteId)
    {
        parent::__construct($httpMethodsClient);
        $this->siteId = $siteId;
    }

    public function findAll(int $price = 1) : Pagerfanta
    {
        return $this->createPaginator("/sites/{$this->siteId}/listing_prices?price=$price");
    }
}
