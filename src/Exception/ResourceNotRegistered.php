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
    /**
     * @type string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('Resource "%s" is not registered', $name));
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
