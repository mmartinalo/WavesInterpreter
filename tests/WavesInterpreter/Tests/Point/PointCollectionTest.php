<?php

namespace WavesInterpreter\Tests\Point;
use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\HashMapPointCollection\HashMapPointCollection;
use WavesInterpreter\Point\PointCollection\SimplePointCollection\SimplePointCollection;


/**
 * Class PointTest
 * @package WavesInterpreter\Tests\Point
 */
class PointTest extends \PHPUnit_Framework_TestCase
{

	public function testSimpleCollection()
	{
		$pointCollection = new SimplePointCollection();

		$this->assertEquals(0, $pointCollection->count());

		$firstPoint = new Point(1,7);
		$secondPoint = new Point(3,12);


		$pointCollection->addPoint($firstPoint);
		$pointCollection->addPoint($secondPoint);

		$this->assertEquals(2, $pointCollection->count());

		$this->assertEquals($firstPoint, $pointCollection->getFirst());
		$this->assertEquals($secondPoint, $pointCollection->getLast());


		$pointCollection->clear();
		$this->assertEquals(0, $pointCollection->count());
	}

	public function testHashMapCollection()
	{
		$pointCollection = new HashMapPointCollection();

		$this->assertEquals(0, $pointCollection->count());

		$firstPoint = new Point(1,7);
		$secondPoint = new Point(3,12);


		$pointCollection->addPoint($firstPoint);
		$pointCollection->addPoint($secondPoint);

		$this->assertEquals(2, $pointCollection->count());

		$this->assertEquals($firstPoint, $pointCollection->getFirst());
		$this->assertEquals($secondPoint, $pointCollection->getLast());


		$pointCollection->clear();
		$this->assertEquals(0, $pointCollection->count());
	}


}