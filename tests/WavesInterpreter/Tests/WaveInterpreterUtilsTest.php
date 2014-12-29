<?php

namespace WavesInterpreter\Tests;

use WavesInterpreter\Point\Point;
use WavesInterpreter\WaveInterpreterUtils;


/**
 * Class WaveInterpreterUtilsTest
 * @package WavesInterpreter\Tests
 */
class WaveInterpreterUtilsTest extends \PHPUnit_Framework_TestCase
{

	/** @var  Point */
	protected $maxPoint;

	/** @var  Point */
	protected $minPoint;


	protected  function setUp()
	{
		$this->maxPoint = new Point(10,19);
		$this->minPoint = new Point(7,1);
	}

	public function testEquals()
	{
		$this->assertTrue(WaveInterpreterUtils::equals($this->maxPoint, $this->maxPoint));
		$this->assertTrue(WaveInterpreterUtils::equals($this->minPoint, $this->minPoint));
		$this->assertFalse(WaveInterpreterUtils::equals($this->maxPoint,$this->minPoint));

	}

	/**
	 * @dataProvider trailProvider
	 */
	public function testMaxPointTrail($points)
	{
		$this->assertEquals($this->maxPoint, WaveInterpreterUtils::getMaxPointTrail($points));
		$this->assertNotEquals($this->minPoint, WaveInterpreterUtils::getMaxPointTrail($points));

	}

	/**
	 * @dataProvider trailProvider
	 */
	public function testMinPointTrail($points)
	{
		$this->assertEquals($this->minPoint, WaveInterpreterUtils::getMinPointTrail($points));
		$this->assertNotEquals($this->maxPoint, WaveInterpreterUtils::getMinPointTrail($points));


	}

	public function testProgresion()
	{

		$this->assertEquals(
		     WaveInterpreterUtils::WAVE_PROGRESSION_UP,
		     WaveInterpreterUtils::getProgression($this->minPoint, $this->maxPoint)
		);
		$this->assertEquals(
		     WaveInterpreterUtils::WAVE_PROGRESSION_DOWN,
		     WaveInterpreterUtils::getProgression($this->maxPoint, $this->minPoint)
		);
		$this->assertEquals(
		     WaveInterpreterUtils::WAVE_PROGRESSION_STRAIGHT,
		     WaveInterpreterUtils::getProgression(new Point(1,7), new Point(15,7))
		);

	}

	/**
	 * @dataProvider trailProvider
	 */
	public function testXDistance($points)
	{
		$this->assertEquals(0,WaveInterpreterUtils::getXDistance(array()));
		$this->assertEquals(1,WaveInterpreterUtils::getXDistance(array($this->maxPoint)));
		$this->assertEquals(1,WaveInterpreterUtils::getXDistance(array($this->minPoint)));
		$this->assertEquals(1,WaveInterpreterUtils::getXDistance(array($points)));

	}

	/**
	 * @dataProvider trailProvider
	 */
	public function testYDistance($points)
	{

		$this->assertEquals(0,WaveInterpreterUtils::getYDistance(array()));
		$this->assertEquals(1,WaveInterpreterUtils::getYDistance(array($this->maxPoint)));
		$this->assertEquals(1,WaveInterpreterUtils::getYDistance(array($this->minPoint)));
		$this->assertEquals(18,WaveInterpreterUtils::getYDistance($points));


	}

	/**
	 * @dataProvider trailProvider
	 */
	public function testIsMax($points)
	{

		$this->assertTrue(WaveInterpreterUtils::isMaximum(new Point(1,50), $points));
		$this->assertFalse(WaveInterpreterUtils::isMaximum($this->maxPoint, $points));
		$this->assertFalse(WaveInterpreterUtils::isMaximum($this->minPoint, $points));

	}

	/**
	 * @dataProvider trailProvider
	 */
	public function testIsMin($points)
	{
		$this->assertTrue(WaveInterpreterUtils::isMinimum(new Point(1,0), $points));
		$this->assertFalse(WaveInterpreterUtils::isMinimum($this->minPoint, $points));
		$this->assertFalse(WaveInterpreterUtils::isMinimum($this->maxPoint, $points));

	}


	public function trailProvider()
	{
		return array(
			array(
				array(
					new Point(1,3),
					new Point(10,19),
					new Point(22,7),
					new Point(7,1),
					new Point(2,2),
				)
			)
		);
	}

}
