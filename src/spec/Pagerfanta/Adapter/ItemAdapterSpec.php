<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Meli\Pagerfanta\Adapter;

use Ivory\HttpAdapter\HttpAdapterInterface;
use Meli\Pagerfanta\Adapter\ItemAdapter;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ItemAdapterSpec extends ObjectBehavior
{
    use \spec\Meli\FixtureTrait;

    function let(
        HttpAdapterInterface $adapter,
        ResponseInterface $response,
        StreamInterface $body
    ) {
        $adapter->get('/search?q=ipod')->willReturn($response);
        $response->getBody()->willReturn($this->loadFixture('ipod'));
        $this->beConstructedWith($adapter, '/search?q=ipod');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ItemAdapter::class);
    }

    function it_returns_the_number_of_results()
    {
        $this->getNbResults()->shouldReturn(2167);
    }

    function it_returns_a_slice_of_results(
        HttpAdapterInterface $adapter,
        ResponseInterface $response,
        StreamInterface $body
    ) {
        $adapter->get('/search?q=ipod&offset=0&limit=50')->willReturn($response);
        $response->getBody()->willReturn($this->loadFixture('ipod'));
        $this->getSlice(0, 50)->shouldHaveCount(50);
    }

    function it_returns_filters()
    {
        $this->getFilters()->shouldHaveCount(1);
    }

    function it_returns_available_filters()
    {
        $this->getAvailableFilters()->shouldHaveCount(14);
    }

    function it_returns_sort()
    {
        $this->getSort()->shouldHaveCount(2);
    }

    function it_returns_available_sorts()
    {
        $this->getAvailableSorts()->shouldHaveCount(2);
    }
}
