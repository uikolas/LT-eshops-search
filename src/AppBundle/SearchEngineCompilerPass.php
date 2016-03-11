<?php

namespace AppBundle;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SearchEngineCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('app.service.search_manager')) {
            return;
        }

        $definition = $container->findDefinition(
            'app.service.search_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'app.service.search_engine'
        );

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'setSearchEngine',
                array(new Reference($id))
            );
        }
    }
}