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
use Meli\Resource\User;
use Meli\Resource\User\AcceptedPaymentMethod;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class UserSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpMethodsClient)
    {
        $this->beConstructedWith($httpMethodsClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function it_returns_listing_type_resource()
    {
        $this->acceptedPaymentMethods(123456789)->shouldHaveType(AcceptedPaymentMethod::class);
    }
}
