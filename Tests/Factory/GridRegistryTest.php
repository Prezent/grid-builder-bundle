<?php

/*
 * (c) Prezent Internet B.V. <info@prezent.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Prezent\Bundle\GridBuilderBundle\Tests\Factory;

use Prezent\Bundle\GridBuilderBundle\Factory\GridRegistry;

class GridRegistryTest extends \PHPUnit_Framework_TestCase
{
    public function testGetBuilder()
    {
        $container = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerInterface');
        $container->expects($this->once())
                  ->method('get')
                  ->with($this->equalTo('id'));

        $registry = new GridRegistry($container, ['alias' => 'id']);
        $registry->getGridBuilder('alias');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetBuilderException()
    {
        $container = $this->getMock('Symfony\\Component\\DependencyInjection\\ContainerInterface');

        $registry = new GridRegistry($container, ['alias' => 'id']);
        $registry->getGridBuilder('nonexistant');
    }
}
