<?php

namespace Plehatron\LimoncelloBundle\Tests\Controller\Unit;

use Mockery;
use Plehatron\LimoncelloBundle\Controller\JsonApiController;
use Plehatron\LimoncelloBundle\DependencyInjection\SymfonyIntegration;
use ReflectionMethod;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    public function testGetResponse()
    {
        $integration = $this->getIntegration();

        $controller = new FixtureTestController();
        $controller->callInitJsonApiSupport($integration);

        $this->expectException(HttpException::class);
        $this->assertEmpty('', $controller->getResponse([]));
    }
}

class FixtureTestController extends JsonApiController
{
}
