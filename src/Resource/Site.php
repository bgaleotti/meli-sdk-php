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
use Meli\Resource\Site\Category as SiteCategory;
use Meli\Resource\Site\ListingExposure;
use Meli\Resource\Site\ListingPrice;
use Meli\Resource\Site\ListingType;
use Meli\Resource\Site\PaymentMethod;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Site extends Resource
{
    public function findById(string $id) : array
    {
        return $this->get("/sites/$id");
    }

    public function findAll() : array
    {
        return $this->createPaginator('/sites');
    }

    public function categories(string $id) : SiteCategory
    {
        return new SiteCategory($this->httpMethodsClient, $id);
    }

    public function listingExposures(string $id) : ListingExposure
    {
        return new ListingExposure($this->httpMethodsClient, $id);
    }

    public function listingPrices(string $id) : ListingPrice
    {
        return new ListingPrice($this->httpMethodsClient, $id);
    }

    public function listingTypes(string $id) : ListingType
    {
        return new ListingType($this->httpMethodsClient, $id);
    }

    public function paymentMethods(string $id) : PaymentMethod
    {
        return new PaymentMethod($this->httpMethodsClient, $id);
    }
}
