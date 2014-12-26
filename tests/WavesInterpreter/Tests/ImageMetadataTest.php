<?php

namespace WavesInterpreter\Tests;

use WavesInterpreter\ImageMetadata;


/**
 * Class WaveInterpreterUtilsTest
 * @package WavesInterpreter\Tests
 */
class WaveInterpreterUtilsTest extends \PHPUnit_Framework_TestCase
{



	protected  function setUp()
	{
	}

	public function testSettersAndGetters()
	{
		$imageMetadata = new ImageMetadata();
		$this->assertNull($imageMetadata->getColors());
		$this->assertNull($imageMetadata->getHeight());
		$this->assertNull($imageMetadata->getImageMap());
		$this->assertNull($imageMetadata->getWidth());

		$imageMetadata->setHeight(100);
		$imageMetadata->setWidth(200);
		$this->assertEquals(100, $imageMetadata->getHeight());
		$this->assertEquals(200, $imageMetadata->getWidth());

	}




//	public function trailProvider()
//	{
//		return array(
//			array(
//				array(
//					new Point(1,3),
//					new Point(10,19),
//					new Point(22,7),
//					new Point(7,1),
//					new Point(2,2),
//				)
//			)
//		);
//	}

}