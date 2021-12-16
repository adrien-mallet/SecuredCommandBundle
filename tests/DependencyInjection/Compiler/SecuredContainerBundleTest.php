<?php

namespace SecuredContainerBundle\Tests\DependencyInjection\Compiler;

use PHPUnit\Framework\TestCase;
use SecuredContainerBundle\DependencyInjection\Compiler\SecuredCompiler;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class SecuredContainerBundleTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRemoveUnauthorizedCommand()
    {
        $container = new ContainerBuilder();
        $container->setDefinition('foo', (new Definition())->addTag('console.command'));
        $container->setDefinition('bar', (new Definition())->addTag('console.command'));
        $container->prependExtensionConfig('secured_container', [
            'unauthorized' => [
                'foo',
            ]
        ]);
        $this->process($container);
        $this->assertFalse($container->hasDefinition('foo'));
        $this->assertTrue($container->hasDefinition('bar'));
    }

    /**
     * @test
     */
    public function shouldNotRemovedNotCommandDefinition()
    {
        $container = new ContainerBuilder();
        $container->setDefinition('foo', new Definition());
        $container->prependExtensionConfig('secured_container', [
            'unauthorized' => [
                'foo',
            ]
        ]);
        $this->process($container);
        $this->assertTrue($container->hasDefinition('foo'));
    }

    /**
     * @test
     */
    public function shouldDoNothing()
    {
        $container = new ContainerBuilder();
        $container->setDefinition('foo', (new Definition())->addTag('console.command'));
        $container->setDefinition('bar', (new Definition())->addTag('console.command'));
        $this->process($container);
        $this->assertTrue($container->hasDefinition('foo'));
        $this->assertTrue($container->hasDefinition('bar'));
    }

    private function process(ContainerBuilder $container)
    {
        (new SecuredCompiler())->process($container);
    }
}