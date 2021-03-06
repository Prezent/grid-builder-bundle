<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\Bundle\GridBuilderBundle\Builder;

use Kitpages\DataGridBundle\Grid\GridConfig;

/**
 * GridBuilderInterface
 */
abstract class AbstractGridBuilder implements GridBuilderInterface
{
    /**
     * Build the grid configuration
     *
     * @param GridConfig $config
     * @param array $options
     * @return void
     */
    abstract public function buildGrid(GridConfig $config, array $options = array());
}
