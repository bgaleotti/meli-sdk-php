<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli\Pagerfanta\Adapter;

use Http\Client\Common\HttpMethodsClient;
use Ivory\HttpAdapter\HttpAdapterInterface;
use Pagerfanta\Adapter\AdapterInterface;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ItemAdapter implements AdapterInterface
{
    private $httpMethodsClient;
    private $uri;
    private $json;

    public function __construct(HttpMethodsClient $httpMethodsClient, string $uri)
    {
        $this->httpMethodsClient = $httpMethodsClient;
        $this->uri = $uri;
    }

    /**
     * {@inheritDoc}
     */
    public function getNbResults()
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return (int) $this->json['paging']['total'];
    }

    /**
     * {@inheritDoc}
     */
    public function getSlice($offset, $length)
    {
        $uri = $this->uri;
        $uri .= "&offset=$offset";
        $uri .= "&limit=$length";

        $this->json = $this->fetchJson($uri);

        return $this->json['results'];
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['filters'];
    }

    /**
     * @return array
     */
    public function getAvailableFilters()
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['available_filters'];
    }

    /**
     * @return array
     */
    public function getSort()
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['sort'];
    }

    /**
     * @return array
     */
    public function getAvailableSorts()
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['available_sorts'];
    }

    /**
     * @param string $uri
     *
     * @return array
     */
    private function fetchJson($uri)
    {
        return json_decode($this->httpMethodsClient->get($uri)->getBody(), true);
    }
}
