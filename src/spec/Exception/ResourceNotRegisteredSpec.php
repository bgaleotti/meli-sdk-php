<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Meli\Exception;

use Meli\Exception\ExceptionInterface;
use Meli\Exception\ResourceNotRegistered;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ResourceNotRegisteredSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ResourceNotRegistered::class);
    }

    function its_a_meli_exception()
    {
        $this->shouldHaveType(ExceptionInterface::class);
    }

    function its_a_runtime_exception()
    {
        $this->shouldHaveType(\RuntimeException::class);
    }

    function it_returns_the_resource_name()
    {
        $this->getName()->shouldReturn('foo');
    }

    function it_returns_a_message()
    {
        $this->getMessage()->shouldReturn('Resource "foo" is not registered');
    }
}
