<?php

namespace Plehatron\LimoncelloBundle\Tests\Unit\Controller;

use Mockery;
use Plehatron\LimoncelloBundle\Controller\JsonApiController;
use Plehatron\LimoncelloBundle\DependencyInjection\SymfonyIntegration;
use ReflectionMethod;
use Symfony\Component\DependencyInjection\Container;

class JsonApiControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return SymfonyIntegration
     */
    private function getIntegration()
    {
        $container = new Container();
        $container->setParameter('plehatron_limoncello', []);
        $integration = new SymfonyIntegration();
        $integration->setContainer($container);
        return $integration;
    }

    public function testCallInit()
    {
        $integration = $this->getIntegration();

        $controller = new FixtureTestController();
        $controller->callInitJsonApiSupport($integration);

        $method = new ReflectionMethod(FixtureTestController::class, 'getIntegration');
        $method->setAccessible(true);
        $this->assertEquals($integration, $method->invoke($controller));
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testGetResponse()
    {
        $integration = $this->getIntegration();

        $controller = new FixtureTestController();
        $controller->callInitJsonApiSupport($integration);

        $this->assertEmpty('', $controller->getResponse([]));
    }
}

class FixtureTestController extends JsonApiController
{
}
