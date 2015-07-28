<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Meli;

use Ivory\HttpAdapter\HttpAdapterInterface;
use Meli\Api;
use Meli\Exception\ResourceNotRegistered;
use Meli\Resource\Category;
use Meli\Resource\City;
use Meli\Resource\Country;
use Meli\Resource\Currency;
use Meli\Resource\CurrencyConversion;
use Meli\Resource\Item;
use Meli\Resource\Site;
use Meli\Resource\SiteDomain;
use Meli\Resource\State;
use Meli\Resource\User;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ApiSpec extends ObjectBehavior
{
    function let(HttpAdapterInterface $adapter)
    {
        $this->beConstructedWith($adapter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Api::class);
    }

    function it_throws_exception_when_calling_an_unknown_resource()
    {
        $this->shouldThrow(ResourceNotRegistered::class)->during('foo');
    }

    function it_returns_known_resources()
    {
        $this->categories()->shouldHaveType(Category::class);
        $this->cities()->shouldHaveType(City::class);
        $this->countries()->shouldHaveType(Country::class);
        $this->currencies()->shouldHaveType(Currency::class);
        $this->currencyConversions()->shouldHaveType(CurrencyConversion::class);
        $this->items()->shouldHaveType(Item::class);
        $this->sites()->shouldHaveType(Site::class);
        $this->siteDomains()->shouldHaveType(SiteDomain::class);
        $this->states()->shouldHaveType(State::class);
        $this->users()->shouldHaveType(User::class);
    }
}
