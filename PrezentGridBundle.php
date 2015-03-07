<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\GridBuilderBundle;

use Prezent\GridBuilderBundle\DependencyInjection\Compiler\GridCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * PrezentGridBuilderBundle
 *
 * @see Bundle
 */
class PrezentGridBuilderBundle extends Bundle
{
    /**
     * @{inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new GridCompilerPass());
    }
}
