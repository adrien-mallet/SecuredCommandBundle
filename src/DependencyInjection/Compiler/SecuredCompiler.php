<?php

namespace SecuredContainerBundle\DependencyInjection\Compiler;

use SecuredContainerBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SecuredCompiler implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig('secured_container');
        $configuration = new Configuration();
        $configsProcessed = $this->processConfiguration($configuration, $configs);

        if (empty($configsProcessed['unauthorized'])) {
            return;
        }

        foreach ($configsProcessed['unauthorized'] as $identifier) {
           if (!$container->hasDefinition($identifier)) {
               continue;
           }

           $definition = $container->getDefinition($identifier);
           if ($definition->hasTag('console.command')) {
               $container->removeDefinition($identifier);
           }
        }
    }

    private function processConfiguration(Configuration $configuration, array $configs)
    {
        $processor = new Processor();

        return $processor->processConfiguration($configuration, $configs);
    }
}