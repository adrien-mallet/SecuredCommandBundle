<?php

namespace SecuredContainerBundle;

use SecuredContainerBundle\DependencyInjection\Compiler\SecuredCompiler;
use SecuredContainerBundle\DependencyInjection\SecuredContainerExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SecuredContainerBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SecuredContainerExtension();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SecuredCompiler());
    }
}