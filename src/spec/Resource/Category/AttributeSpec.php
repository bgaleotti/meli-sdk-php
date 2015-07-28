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

use Ivory\HttpAdapter\HttpAdapterInterface;
use Meli\Resource\Category\Attribute;
use PhpSpec\ObjectBehavior;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class AttributeSpec extends ObjectBehavior
{
    function let(HttpAdapterInterface $adapter)
    {
        $this->beConstructedWith($adapter, 'MLA5725');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Attribute::class);
    }
}
