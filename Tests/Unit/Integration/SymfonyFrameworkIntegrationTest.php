<?php

namespace Plehatron\LimoncelloBundle\Tests\Integration\Unit;

use Mockery;
use Plehatron\LimoncelloBundle\Integration\SymfonyFrameworkIntegration;
use stdClass;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class SymfonyFrameworkIntegrationTest extends \PHPUnit_Framework_TestCase
{
    private function getIntegration()
    {
        $container = Mockery::mock(ContainerInterface::class);
        $container->shouldReceive('getParameter')->withArgs(['plehatron_limoncello'])->andReturn([]);
        $container->shouldReceive('get')->withArgs(['request_stack'])->andReturn(
            Mockery::mock(RequestStack::class)->shouldReceive('getCurrentRequest')->andReturn(null)->getMock());
        $container->shouldReceive('set')->withAnyArgs();
        $container->shouldReceive('has')->withArgs(['yep'])->andReturn(true);
        $container->shouldReceive('has')->withArgs(['nope'])->andReturn(false);
        $integration = new SymfonyFrameworkIntegration();
        $integration->setContainer($container);
        return $integration;
    }

    public function testGetConfig()
    {
        $this->assertEquals([], $this->getIntegration()->getConfig());
    }

    public function testGetCurrentRequest()
    {
        $this->assertNull($this->getIntegration()->getCurrentRequest());
    }

    public function testGetFrom()
    {
        $this->assertInstanceOf(RequestStack::class, $this->getIntegration()->getFromContainer('request_stack'));
    }

    public function testSetHasInContainer()
    {
        $integration = $this->getIntegration();
        $integration->setInContainer(stdClass::class, new stdClass());
        $this->assertTrue($integration->hasInContainer('yep'));
        $this->assertFalse($integration->hasInContainer('nope'));
    }

    public function testCreateRequest()
    {
        $integration = $this->getIntegration();
        $response = $integration->createResponse('x', 200, ['Content-Type' => 'application/json']);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }
}
