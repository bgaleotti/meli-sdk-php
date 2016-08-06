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
use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\AddHostPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;
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
    const VERSION  = '0.2-DEV';

    protected $httpClient;
    protected $messageFactory;
    protected $uriFactory;
    protected $httpMethodsClient;

    private $resources = [];

    public static function create() : self
    {
        return new self(
            HttpClientDiscovery::find(),
            MessageFactoryDiscovery::find(),
            UriFactoryDiscovery::find()
        );
    }

    public function __construct(HttpClient $httpClient, MessageFactory $messageFactory, UriFactory $uriFactory)
    {
        $httpClient = new PluginClient($httpClient, [
           new AddHostPlugin($uriFactory->createUri(self::BASE_URL))
        ]);

        $this->httpClient = $httpClient;
        $this->messageFactory = $messageFactory;
        $this->uriFactory = $uriFactory;
        $this->httpMethodsClient = new HttpMethodsClient($httpClient, $messageFactory);

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
            $className  = $file->getBasename('.php');
            $reflectionClass = new \ReflectionClass($namespace.'\\'.$className);
            if ($reflectionClass->isSubclassOf(Resource::class) && !$reflectionClass->isAbstract()) {
                $resource = $reflectionClass->newInstanceArgs([$this->httpMethodsClient]);
                $resourceName = Inflector::pluralize(Inflector::camelize($className));
                $this->resources[$resourceName] = $resource;
            }
        }
    }
}
