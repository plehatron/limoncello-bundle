<?php

namespace Plehatron\LimoncelloBundle\DependencyInjection;

use Neomerx\Limoncello\Http\FrameworkIntegration;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Response;

class SymfonyIntegration extends FrameworkIntegration
{
    use ContainerAwareTrait;

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        return $this->container->getParameter('plehatron_limoncello');
    }

    /**
     * @inheritdoc
     */
    public function getCurrentRequest()
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }

    /**
     * @inheritdoc
     */
    public function getFromContainer($key)
    {
        return $this->container->get($key);
    }

    /**
     * @inheritdoc
     */
    public function setInContainer($key, $value)
    {
        $this->container->set($key, $value);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function hasInContainer($key)
    {
        return $this->container->has($key);
    }

    /**
     * @inheritdoc
     */
    public function createResponse($content, $statusCode, array $headers)
    {
        return new Response($content, $statusCode, $headers);
    }
}