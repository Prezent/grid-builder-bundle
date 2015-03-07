<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\GridBuilderBundle\Factory;

use Prezent\GridBuilderBundle\Builder\GridBuilderInterface;

/**
 * GridRegistryInterface
 */
interface GridRegistryInterface
{
    /**
     * Get a grid builder
     *
     * @param string $name
     * @return GridBuilderInterface
     */
    public function getGridBuilder($name);
}
