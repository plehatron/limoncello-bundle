<?php

namespace Plehatron\LimoncelloBundle\Tests\Unit\EventListener;

use Mockery;
use Plehatron\LimoncelloBundle\Controller\JsonApiController;
use Plehatron\LimoncelloBundle\EventListener\JsonApiControllerListener;
use Plehatron\LimoncelloBundle\DependencyInjection\SymfonyIntegration;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class JsonApiControllerListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testOnKernelController()
    {
        $integration = Mockery::mock(SymfonyIntegration::class);
        $controller = Mockery::mock(JsonApiController::class);
        $controller->shouldReceive('callInitJsonApiSupport')->withArgs([$integration])->andReturnUndefined();
        $event = Mockery::mock(FilterControllerEvent::class);
        $event->shouldReceive('getController')->withNoArgs()->andReturn([0 => $controller]);

        $listener = new JsonApiControllerListener();
        $listener->setIntegration($integration);
        $listener->onKernelController($event);

        $event->shouldHaveReceived('getController')->once();
        $controller->shouldHaveReceived('callInitJsonApiSupport')->once();
    }
}
