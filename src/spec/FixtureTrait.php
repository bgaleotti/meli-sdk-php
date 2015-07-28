<?php

/*
 * This file is part of the Meli library.
 *
 * (c) Bruno Galeotti <bgaleotti@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace spec\Meli;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
trait FixtureTrait
{
    /**
     * @param string $fixture
     *
     * @return string
     */
    protected function loadFixture($fixture)
    {
        if (!file_exists($filename = __DIR__.DIRECTORY_SEPARATOR.'Fixtures'.DIRECTORY_SEPARATOR.$fixture.'.json')) {
            throw new \RuntimeException(sprintf('Could not load fixture "%s"', $filename));
        }

        return file_get_contents($filename);
    }

    /**
     * @param string $fixture
     *
     * @return array
     */
    protected function loadFixtureAsJson($fixture)
    {
        return json_decode($this->loadFixture($fixture), true);
    }
}
