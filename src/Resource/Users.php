<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli\Resource;

use Meli\Resource;
use Meli\Resource\User\AcceptedPaymentMethods;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Users extends Resource
{
    public function findById(string $id) : array
    {
        return $this->get("/users/$id");
    }

    public function acceptedPaymentMethods(string $id) : AcceptedPaymentMethods
    {
        return new AcceptedPaymentMethods($this->httpMethodsClient, $id);
    }
}
