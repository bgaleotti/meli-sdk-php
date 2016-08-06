<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Meli\Resource\Category;

use Http\Client\Common\HttpMethodsClient;
use Meli\Resource\Category\Attributes;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class AttributesSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpMethodsClient)
    {
        $this->beConstructedWith($httpMethodsClient, 'MLA5725');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Attributes::class);
    }
}
