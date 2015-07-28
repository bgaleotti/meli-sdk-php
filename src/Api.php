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

use Doctrine\Common\Inflector\Inflector;
use Ivory\HttpAdapter\Configuration;
use Ivory\HttpAdapter\ConfigurationInterface;
use Ivory\HttpAdapter\HttpAdapterInterface;
use Meli\Exception\ResourceNotRegistered;
use Symfony\Component\Finder\Finder;

/**
 * @author Bruno Galeotti <bgaleotti@gmail.com>
 */
class Api
{
    const BASE_URL = 'https://api.mercadolibre.com';
    const VERSION  = '0.1-DEV';

    /**
     * @type HttpAdapterInterface
     */
    protected $adapter;

    /**
     * @type Resource[]
     */
    private $resources = [];

    /**
     * @param HttpAdapterInterface        $adapter
     * @param ConfigurationInterface|null $configuration
     */
    public function __construct(HttpAdapterInterface $adapter, ConfigurationInterface $configuration = null)
    {
        $this->adapter = $adapter;
        $this->adapter->setConfiguration($configuration ?: $this->createConfiguration());
        $this->registerResources();
    }

    /**
     * @throws ResourceNotRegistered
     *
     * @return Resource
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }

        if (!array_key_exists($name, $this->resources)) {
            throw new ResourceNotRegistered($name);
        }

        return $this->resources[$name];
    }

    protected function registerResources()
    {
        $finder = new Finder();
        $finder->files()->in(__DIR__.'/Resource')->depth(0);

        $namespace = __NAMESPACE__.'\\Resource';
        foreach ($finder as $file) {
            $className       = $file->getBasename('.php');
            $reflectionClass = new \ReflectionClass($namespace.'\\'.$className);
            if ($reflectionClass->isSubclassOf(Resource::class) && !$reflectionClass->isAbstract()) {
                $resource                       = $reflectionClass->newInstanceArgs([$this->adapter]);
                $resourceName                   = Inflector::pluralize(Inflector::camelize($className));
                $this->resources[$resourceName] = $resource;
            }
        }
    }

    /**
     * @return ConfigurationInterface
     */
    protected function createConfiguration()
    {
        $configuration = new Configuration();
        $configuration->setBaseUri(self::BASE_URL);
        $configuration->setUserAgent('MeliPHP/'.self::VERSION);

        return $configuration;
    }
}
