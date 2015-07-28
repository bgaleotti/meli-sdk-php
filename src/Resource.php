<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli;

use Ivory\HttpAdapter\HttpAdapterInterface;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
abstract class Resource
{
    /**
     * @type HttpAdapterInterface
     */
    protected $adapter;

    /**
     * @param HttpAdapterInterface $adapter
     */
    public function __construct(HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return array
     */
    protected function get($uri, array $options = [])
    {
        return json_decode($this->adapter->get($uri, $options)->getBody(), true);
    }

    /**
     * @param string $uri
     *
     * @return Pagerfanta
     */
    protected function createPaginator($uri)
    {
        return new Pagerfanta($this->createPaginatorAdapter($uri));
    }

    /**
     * @param string $uri
     *
     * @return ArrayAdapter
     */
    protected function createPaginatorAdapter($uri)
    {
        return new ArrayAdapter($this->get($uri));
    }
}
