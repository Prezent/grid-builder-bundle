<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\Bundle\GridBuilderBundle\Factory;

use Doctrine\ORM\QueryBuilder;
use Kitpages\DataGridBundle\Grid\Grid;
use Kitpages\DataGridBundle\Grid\GridConfig;
use Kitpages\DataGridBundle\Grid\GridManager;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Grid factory
 */
class GridFactory
{
    /**
     * @var GridRegistryInterface
     */
    private $registry;

    /**
     * @var GridManager
     */
    private $manager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * Constructor
     *
     * @param GridRegistryInterface $registry
     * @param GridManager $manager
     * @param RequestStack $requestStack
     */
    public function __construct(GridRegistryInterface $registry, GridManager $manager, RequestStack $requestStack)
    {
        $this->registry = $registry;
        $this->manager = $manager;
        $this->requestStack = $requestStack;
    }

    /**
     * Create a grid configuration using a named builder
     *
     * @param string       $name
     * @param QueryBuilder $qb
     * @param array        $options
     * @return GridConfig
     */
    public function createGridConfig($name, QueryBuilder $qb, array $options = array())
    {
        $config = new GridConfig();

        $config->setName($name);
        $config->setQueryBuilder($qb);

        $builder = $this->registry->getGridBuilder($name);
        $builder->buildGrid($config, $options);

        return $config;
    }

    /**
     * Create a grid
     *
     * @param string $name
     * @param QueryBuilder $qb
     * @param array $options
     * @return Grid
     */
    public function createGrid($name, QueryBuilder $qb, array $options = array())
    {
        return $this->manager->getGrid($this->createGridConfig($name, $qb, $options), $this->requestStack->getCurrentRequest());
    }
}
