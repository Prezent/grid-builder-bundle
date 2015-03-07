<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\GridBuilderBundle\Tests\Factory;

use Prezent\GridBuilderBundle\Factory\GridFactory;
use Prezent\GridBuilderBundle\Factory\GridRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class GridFactoryTest extends \PHPUnit_Framework_TestCase
{
    private $builder;
    private $container;
    private $registry;
    private $manager;

    public function setUp()
    {
        $this->builder = $this->getMock('Prezent\\GridBundle\\Builder\\GridBuilderInterface');
        $this->builder
            ->expects($this->once())
            ->method('buildGrid')
            ->will($this->returnArgument(0));

        $this->container = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerInterface');
        $this->container
            ->expects($this->once())
            ->method('get')
            ->with($this->equalTo('id'))
            ->will($this->returnValue($this->builder));

        $this->manager = $this
            ->getMockBuilder('Kitpages\\DataGridBundle\\Service\\GridManager')
            ->disableOriginalConstructor()
            ->getMock();

        $this->registry = new GridRegistry($this->container, ['alias' => 'id']);
    }

    public function testCreateConfig()
    {
        $factory = new GridFactory($this->registry, $this->manager, new RequestStack());
        $qb = $this
            ->getMockBuilder('Doctrine\\ORM\\QueryBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $factory->createGridConfig('alias', $qb);
    }

    public function testCreate()
    {
        $request = new Request();
        $requestStack = new RequestStack();
        $requestStack->push($request);

        $qb = $this
            ->getMockBuilder('Doctrine\\ORM\\QueryBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        $this->manager
            ->expects($this->once())
            ->method('getGrid')
            ->with(
                $this->identicalTo($qb),
                $this->isInstanceOf('KitPages\\DataGridBundle\\Model\\GridConfig'),
                $this->identicalTo($request)
            );

        $factory = new GridFactory($this->registry, $this->manager, $requestStack);
        $factory->createGrid('alias', $qb);
    }
}
