<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\Bundle\GridBuilderBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Add all services tagged "prezent_grid.grid" to the grid registry
 *
 * @see CompilerPassInterface
 */
class GridCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('prezent_grid.registry')) {
            return;
        }

        $definition = $container->getDefinition('prezent_grid.registry');

        $grids = array();
        foreach ($container->findTaggedServiceIds('prezent_grid.grid') as $serviceId => $tag) {
            $alias = isset($tag[0]['alias']) ? $tag[0]['alias'] : $serviceId;
            $grids[$alias] = $serviceId;
        }

        $definition->replaceArgument(1, $grids);
    }
}
