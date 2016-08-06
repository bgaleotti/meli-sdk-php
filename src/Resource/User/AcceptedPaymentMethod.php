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
use Pagerfanta\Pagerfanta;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class AcceptedPaymentMethod extends Resource
{
    protected $userId;

    public function __construct(HttpMethodsClient $httpMethodsClient, string $userId)
    {
        parent::__construct($httpMethodsClient);
        $this->userId = $userId;
    }

    public function findAll() : Pagerfanta
    {
        return $this->createPaginator("/users/{$this->userId}/accepted_payment_methods");
    }
}
