<?php

namespace WavesInterpreter\Tests\Wave;

use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\SimplePointCollection\SimplePointCollection;
use WavesInterpreter\Wave\Complex\ComplexWave;
use WavesInterpreter\Wave\Proxy\ProxyWave;


/**
 * Class ProxyWaveTest
 * @package WavesInterpreter\Tests\Wave
 */
class ProxyWaveTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \WavesInterpreter\Exception\WaveException
     */
    public function testAdd()
    {

        $proxyWave = new ProxyWave(new ComplexWave(new SimplePointCollection()));
        $proxyWave->addPoint(new Point(1,1));

    }

    /**
     * @dataProvider collectionProvider
     */
	public function testFirst($collection)
	{
        $proxyWave = new ProxyWave(new ComplexWave($collection));

		$this->assertEquals(new Point(1,3), $proxyWave->getFirstPoint());

	}

    /**
     * @dataProvider collectionProvider
     */
    public function testLast($collection)
    {
        $proxyWave = new ProxyWave(new ComplexWave($collection));

        $this->assertEquals(new Point(22,7), $proxyWave->getLastPoint());

    }

    /**
     * @dataProvider collectionProvider
     */
    public function testMin($collection)
    {
        $proxyWave = new ProxyWave(new ComplexWave($collection));

        $this->assertEquals(new Point(7,1), $proxyWave->getMinPoint());


    }

    /**
     * @dataProvider collectionProvider
     */
    public function testMax($collection)
    {
        $proxyWave = new ProxyWave(new ComplexWave($collection));

        $this->assertEquals(new Point(10,19), $proxyWave->getMaxPoint());

    }

    /**
     * @dataProvider collectionProvider
     */
    public function testHashMapCrestAndTrough($collection)
    {
        $proxyWave = new ProxyWave(new ComplexWave($collection));

        $this->assertCount(1, $proxyWave->getCrest());
        $this->assertCount(1, $proxyWave->getTrough());

    }

	public function collectionProvider()
	{
        $simpleCollection = new SimplePointCollection();
        $simpleCollection->addPoint(new Point(1,3));
        $simpleCollection->addPoint(new Point(2,2));
        $simpleCollection->addPoint(new Point(7,1));
        $simpleCollection->addPoint(new Point(10,19));
        $simpleCollection->addPoint(new Point(22,7));

		return array(
			array(
                $simpleCollection
			)
		);
	}



}
