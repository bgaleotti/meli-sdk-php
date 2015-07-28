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

use Ivory\HttpAdapter\HttpAdapterInterface;
use Meli\Resource\Site;
use Meli\Resource\Site\Category;
use Meli\Resource\Site\ListingExposure;
use Meli\Resource\Site\ListingPrice;
use Meli\Resource\Site\ListingType;
use Meli\Resource\Site\PaymentMethod;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class SiteSpec extends ObjectBehavior
{
    function let(HttpAdapterInterface $adapter)
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Site::class);
    }

    function it_returns_category_resource()
    {
        $this->categories('MLA')->shouldHaveType(Category::class);
    }

    function it_returns_listing_exposure_resource()
    {
        $this->listingExposures('MLA')->shouldHaveType(ListingExposure::class);
    }

    function it_returns_listring_price_resource()
    {
        $this->listingPrices('MLA')->shouldHaveType(ListingPrice::class);
    }

    function it_returns_listing_type_resource()
    {
        $this->listingTypes('MLA')->shouldHaveType(ListingType::class);
    }

    function it_returns_payment_method_resource()
    {
        $this->paymentMethods('MLA')->shouldHaveType(PaymentMethod::class);
    }
}
