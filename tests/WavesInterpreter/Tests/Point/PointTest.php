<?php

namespace WavesInterpreter\Tests\Enviroment;


use WavesInterpreter\Point\Point;


/**
 * Class PointTest
 * @package WavesInterpreter\Tests\Enviroment
 */
class PointTest extends \PHPUnit_Framework_TestCase
{

	public function testPoint()
	{
		$point = new Point(1 ,1);

		$this->assertEquals(1, $point->getX());
		$this->assertEquals(1, $point->getY());

		$point->setX(45);
		$point->setY(732);

		$this->assertEquals(45, $point->getX());
		$this->assertEquals(732, $point->getY());
	}


}