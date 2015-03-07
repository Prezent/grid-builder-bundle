<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\GridBuilderBundle\Factory;

use Prezent\GridBuilderBundle\Builder\GridBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Grid registry
 */
class GridRegistry implements GridRegistryInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var array
     */
    private $serviceIds = array();

    /**
     * Constructor
     *
     * @param ContainerInterface $container
     * @param array $serviceIds
     */
    public function __construct(ContainerInterface $container, array $serviceIds)
    {
        $this->container = $container;
        $this->serviceIds = $serviceIds;
    }

    /**
     * Get a grid builder
     *
     * @param string $name
     * @throws \InvalidArgumentException
     * @return GridBuilderInterface
     */
    public function getGridBuilder($name)
    {
        if (!isset($this->serviceIds[$name])) {
            throw new \InvalidArgumentException(sprintf('Invalid grid name "%s"', $name));
        }

        return $this->container->get($this->serviceIds[$name]);
    }
}
