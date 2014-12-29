<?php

namespace WavesInterpreter\Tests\Wave;

use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\HashMapPointCollection\HashMapPointCollection;
use WavesInterpreter\Point\PointCollection\SimplePointCollection\SimplePointCollection;
use WavesInterpreter\Wave\Complex\ComplexWave;


/**
 * Class ComplexWaveTest
 * @package WavesInterpreter\Tests\Wave
 */
class ComplexWaveTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider simpleCollectionProvider
     */
	public function testSimpleFirstAndLast($collection)
	{
        $complexWave = new ComplexWave($collection);

		$this->assertEquals(new Point(1,3), $complexWave->getFirstPoint());
        $this->assertEquals(new Point(22,7), $complexWave->getLastPoint());

	}

    /**
     * @dataProvider hashMapCollectionProvider
     */
    public function testHashMapFirstAndLast($collection)
    {
        $complexWave = new ComplexWave($collection);

        $this->assertEquals(new Point(1,3), $complexWave->getFirstPoint());
        $this->assertEquals(new Point(22,7), $complexWave->getLastPoint());

    }

    /**
     * @dataProvider simpleCollectionProvider
     */
    public function testSimpleMinAndMax($collection)
    {
        $complexWave = new ComplexWave($collection);

        $this->assertEquals(new Point(10,19), $complexWave->getMaxPoint());
        $this->assertEquals(new Point(7,1), $complexWave->getMinPoint());


    }

    /**
     * @dataProvider hashMapCollectionProvider
     */
    public function testHashMapMinAndMax($collection)
    {
        $complexWave = new ComplexWave($collection);

        $this->assertEquals(new Point(10,19), $complexWave->getMaxPoint());
        $this->assertEquals(new Point(7,1), $complexWave->getMinPoint());

    }

    /**
     * @dataProvider simpleCollectionProvider
     */
    public function testSimpleCrestAndTrough($collection)
    {
        $complexWave = new ComplexWave($collection);

        $this->assertCount(1, $complexWave->getCrest());
        $this->assertCount(1, $complexWave->getTrough());

        $complexWave->addPoint(new Point(23,12));
        $this->assertCount(1, $complexWave->getCrest());
        $this->assertCount(2, $complexWave->getTrough());

        $complexWave->addPoint(new Point(24,10));
        $this->assertCount(2, $complexWave->getCrest());
        $this->assertCount(2, $complexWave->getTrough());

    }

    /**
     * @dataProvider hashMapCollectionProvider
     */
    public function testHashMapCrestAndTrough($collection)
    {
        $complexWave = new ComplexWave($collection);

        $this->assertCount(1, $complexWave->getCrest());
        $this->assertCount(1, $complexWave->getTrough());

        $complexWave->addPoint(new Point(23,12));
        $this->assertCount(1, $complexWave->getCrest());
        $this->assertCount(2, $complexWave->getTrough());

        $complexWave->addPoint(new Point(24,10));
        $this->assertCount(2, $complexWave->getCrest());
        $this->assertCount(2, $complexWave->getTrough());
    }

	public function simpleCollectionProvider()
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

    public function hashMapCollectionProvider()
    {
        $hashMapCollection = new HashMapPointCollection();
        $hashMapCollection->addPoint(new Point(1,3));
        $hashMapCollection->addPoint(new Point(2,2));
        $hashMapCollection->addPoint(new Point(7,1));
        $hashMapCollection->addPoint(new Point(10,19));
        $hashMapCollection->addPoint(new Point(22,7));

        return array(
            array(
                $hashMapCollection
            )
        );
    }

}
