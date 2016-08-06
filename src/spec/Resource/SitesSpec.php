<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Meli\Resource;

use Http\Client\Common\HttpMethodsClient;
use Meli\Resource\Site\Categories;
use Meli\Resource\Site\ListingExposures;
use Meli\Resource\Site\ListingPrices;
use Meli\Resource\Site\ListingTypes;
use Meli\Resource\Site\PaymentMethods;
use Meli\Resource\Sites;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class SitesSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpMethodsClient)
    {
        $this->beConstructedWith($httpMethodsClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Sites::class);
    }

    function it_returns_category_resource()
    {
        $this->categories('MLA')->shouldHaveType(Categories::class);
    }

    function it_returns_listing_exposure_resource()
    {
        $this->listingExposures('MLA')->shouldHaveType(ListingExposures::class);
    }

    function it_returns_listring_price_resource()
    {
        $this->listingPrices('MLA')->shouldHaveType(ListingPrices::class);
    }

    function it_returns_listing_type_resource()
    {
        $this->listingTypes('MLA')->shouldHaveType(ListingTypes::class);
    }

    function it_returns_payment_method_resource()
    {
        $this->paymentMethods('MLA')->shouldHaveType(PaymentMethods::class);
    }
}
