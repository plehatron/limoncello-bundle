<?php

namespace Plehatron\LimoncelloBundle\Tests\Unit\DependencyInjection;

use Mockery;
use Neomerx\Limoncello\Config\Config as C;
use Plehatron\LimoncelloBundle\DependencyInjection\PlehatronLimoncelloExtension;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PlehatronLimoncelloExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadFail()
    {
        $cb = new ContainerBuilder();

        $this->expectException(InvalidConfigurationException::class);

        $extension = new PlehatronLimoncelloExtension();
        $extension->load([], $cb);
    }

    public function testLoadPass()
    {
        $cb = new ContainerBuilder();

        $extension = new PlehatronLimoncelloExtension();
        $extension->load(['plehatron_limoncello' => [
            'schemas' => [
                'Plehatron\\CategorySchema'
            ],
            'json' => [
                'options' => C::JSON_OPTIONS_DEFAULT,
                'depth' => C::JSON_DEPTH_DEFAULT,
                'showVer' => C::JSON_IS_SHOW_VERSION_DEFAULT,
                'verMeta' => 'v1.0',
                'urlPrefix' => '/'
            ]
        ]], $cb);

        $this->assertTrue($cb->hasParameter('plehatron_limoncello'));
        $this->assertEquals(['Plehatron\\CategorySchema'], $cb->getParameter('plehatron_limoncello')['schemas']);
    }
}
