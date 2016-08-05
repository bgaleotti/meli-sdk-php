<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli\Resource\User;

use Http\Client\Common\HttpMethodsClient;
use Meli\Resource;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class AcceptedPaymentMethod extends Resource
{
    /**
     * @type string
     */
    protected $userId;

    /**
     * @param HttpMethodsClient $httpMethodsClient
     * @param string               $userId
     */
    public function __construct(HttpMethodsClient $httpMethodsClient, $userId)
    {
        parent::__construct($httpMethodsClient);
        $this->userId = $userId;
    }

    public function findAll()
    {
        return $this->createPaginator("/users/{$this->userId}/accepted_payment_methods");
    }
}
