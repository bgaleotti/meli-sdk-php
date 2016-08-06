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

    public function getNbResults()
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return (int) $this->json['paging']['total'];
    }

    public function getSlice($offset, $length)
    {
        $uri = $this->uri;
        $uri .= "&offset=$offset";
        $uri .= "&limit=$length";

        $this->json = $this->fetchJson($uri);

        return $this->json['results'];
    }

    public function getFilters() : array
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['filters'];
    }

    public function getAvailableFilters() : array
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['available_filters'];
    }

    public function getSort() : array
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['sort'];
    }

    public function getAvailableSorts() : array
    {
        if (!$this->json) {
            $this->json = $this->fetchJson($this->uri);
        }

        return $this->json['available_sorts'];
    }

    private function fetchJson(string $uri) : array
    {
        return json_decode($this->httpMethodsClient->get($uri)->getBody(), true);
    }
}
