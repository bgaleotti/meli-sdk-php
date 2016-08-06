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
use Meli\Resource\Categories;
use Meli\Resource\Category\Attributes;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class CategoriesSpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpMethodsClient)
    {
        $this->beConstructedWith($httpMethodsClient);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Categories::class);
    }

    function it_returns_category_attribute_resource()
    {
        $this->attributes('MLA109291')->shouldHaveType(Attributes::class);
    }
}
