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

use Http\Client\Common\HttpMethodsClient;
use Pagerfanta\Adapter\AdapterInterface;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
abstract class Resource
{
    protected $httpMethodsClient;

    public function __construct(HttpMethodsClient $httpMethodsClient)
    {
        $this->httpMethodsClient = $httpMethodsClient;
    }

    protected function get(string $uri) : array
    {
        $response = $this->httpMethodsClient->get($uri);

        return json_decode((string) $response->getBody(), true);
    }

    protected function createPaginator(string $uri) : Pagerfanta
    {
        return new Pagerfanta($this->createPaginatorAdapter($uri));
    }

    protected function createPaginatorAdapter(string $uri) : AdapterInterface
    {
        return new ArrayAdapter($this->get($uri));
    }
}
