<?php

namespace WavesInterpreter\Tests\Wave;

use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\HashMapPointCollection\HashMapPointCollection;
use WavesInterpreter\Point\PointCollection\SimplePointCollection\SimplePointCollection;
use WavesInterpreter\Wave\Simple\SimpleWave;


/**
 * Class SimpleWaveTest
 * @package WavesInterpreter\Tests\Wave
 */
class SimpleWaveTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider simpleCollectionProvider
     */
	public function testSimpleFirstAndLast($collection)
	{
        $simpleWave = new SimpleWave($collection);

		$this->assertEquals(new Point(1,3), $simpleWave->getFirstPoint());
        $this->assertEquals(new Point(22,7), $simpleWave->getLastPoint());

	}

    /**
     * @dataProvider hashMapCollectionProvider
     */
    public function testHashMapFirstAndLast($collection)
    {
        $simpleWave = new SimpleWave($collection);

        $this->assertEquals(new Point(1,3), $simpleWave->getFirstPoint());
        $this->assertEquals(new Point(22,7), $simpleWave->getLastPoint());

    }

    /**
     * @expectedException \WavesInterpreter\Exception\WaveException
     */
    public function testMin()
    {

        $simpleWave = new SimpleWave(new SimplePointCollection());
        $simpleWave->getMinPoint();

    }

    /**
     * @expectedException \WavesInterpreter\Exception\WaveException
     */
    public function testMax()
    {
        $simpleWave = new SimpleWave(new SimplePointCollection());
        $simpleWave->getMaxPoint();

    }

    /**
     * @expectedException \WavesInterpreter\Exception\WaveException
     */
    public function testCrest()
    {
        $simpleWave = new SimpleWave(new SimplePointCollection());
        $simpleWave->getCrest();

    }

    /**
     * @expectedException \WavesInterpreter\Exception\WaveException
     */
    public function testTrough()
    {
        $simpleWave = new SimpleWave(new SimplePointCollection());
        $simpleWave->getTrough();

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
