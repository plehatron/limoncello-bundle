<?php

namespace Plehatron\LimoncelloBundle\EventListener;

use Neomerx\Limoncello\Contracts\IntegrationInterface;
use Plehatron\LimoncelloBundle\Controller\JsonApiController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class JsonApiControllerListener
{
    /**
     * @var IntegrationInterface
     */
    private $integration;

    /**
     * @param IntegrationInterface $integration
     * @return $this
     */
    public function setIntegration(IntegrationInterface $integration)
    {
        $this->integration = $integration;
        return $this;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        if ($controller[0] instanceof JsonApiController) {
            /** @var JsonApiController $jsonApiController */
            $jsonApiController = $controller[0];
            $jsonApiController->callInitJsonApiSupport($this->integration);
        }
    }
}
