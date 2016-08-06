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

use Http\Client\Common\HttpMethodsClient;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;
use Meli\Api;
use Meli\Exception\ResourceNotRegistered;
use Meli\Resource\Categories;
use Meli\Resource\Cities;
use Meli\Resource\Countries;
use Meli\Resource\Currencies;
use Meli\Resource\CurrencyConversions;
use Meli\Resource\Items;
use Meli\Resource\Sites;
use Meli\Resource\SiteDomains;
use Meli\Resource\States;
use Meli\Resource\Users;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\UriInterface;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ApiSpec extends ObjectBehavior
{
    function let(
        HttpMethodsClient $httpMethodsClient,
        MessageFactory $messageFactory,
        UriFactory $uriFactory,
        UriInterface $baseUri
    ) {
        $uriFactory->createUri(Api::BASE_URL)->willReturn($baseUri);
        $this->beConstructedWith($httpMethodsClient, $messageFactory, $uriFactory);
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
        $this->categories()->shouldHaveType(Categories::class);
        $this->cities()->shouldHaveType(Cities::class);
        $this->countries()->shouldHaveType(Countries::class);
        $this->currencies()->shouldHaveType(Currencies::class);
        $this->currencyConversions()->shouldHaveType(CurrencyConversions::class);
        $this->items()->shouldHaveType(Items::class);
        $this->sites()->shouldHaveType(Sites::class);
        $this->siteDomains()->shouldHaveType(SiteDomains::class);
        $this->states()->shouldHaveType(States::class);
        $this->users()->shouldHaveType(Users::class);
    }
}
