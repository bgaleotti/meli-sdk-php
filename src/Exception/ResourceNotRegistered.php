<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Meli\Exception;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class ResourceNotRegistered extends \RuntimeException implements ExceptionInterface
{
    private $name;

    public function __construct(string $name)
    {
        parent::__construct(sprintf('Resource "%s" is not registered', $name));
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }
}
