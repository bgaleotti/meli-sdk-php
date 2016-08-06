<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Meli\Resource\Site;

use Http\Client\Common\HttpMethodsClient;
use Meli\Resource\Site\Category;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class CategorySpec extends ObjectBehavior
{
    function let(HttpMethodsClient $httpMethodsClient)
    {
        $this->beConstructedWith($httpMethodsClient, 'MLA');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Category::class);
    }
}
