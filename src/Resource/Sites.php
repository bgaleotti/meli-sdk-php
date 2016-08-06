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
use Meli\Resource\Site\Categories as SiteCategories;
use Meli\Resource\Site\ListingExposures;
use Meli\Resource\Site\ListingPrices;
use Meli\Resource\Site\ListingTypes;
use Meli\Resource\Site\PaymentMethods;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Sites extends Resource
{
    public function findById(string $id) : array
    {
        return $this->get("/sites/$id");
    }

    public function findAll() : array
    {
        return $this->createPaginator('/sites');
    }

    public function categories(string $id) : SiteCategories
    {
        return new SiteCategories($this->httpMethodsClient, $id);
    }

    public function listingExposures(string $id) : ListingExposures
    {
        return new ListingExposures($this->httpMethodsClient, $id);
    }

    public function listingPrices(string $id) : ListingPrices
    {
        return new ListingPrices($this->httpMethodsClient, $id);
    }

    public function listingTypes(string $id) : ListingTypes
    {
        return new ListingTypes($this->httpMethodsClient, $id);
    }

    public function paymentMethods(string $id) : PaymentMethods
    {
        return new PaymentMethods($this->httpMethodsClient, $id);
    }
}
