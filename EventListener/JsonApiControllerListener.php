<?php

namespace Plehatron\LimoncelloBundle\EventListener;

use Neomerx\Limoncello\Http\FrameworkIntegration;
use Plehatron\LimoncelloBundle\Controller\JsonApiController;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class JsonApiControllerListener
{
    /**
     * @var FrameworkIntegration
     */
    private $integration;

    /**
     * @param FrameworkIntegration $integration
     * @return $this
     */
    public function setIntegration(FrameworkIntegration $integration)
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
