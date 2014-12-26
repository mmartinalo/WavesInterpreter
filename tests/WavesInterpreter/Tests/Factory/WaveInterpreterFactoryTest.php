<?php

namespace WavesInterpreter\Tests\Factory;

use WavesInterpreter\Factory\WaveInterpreter\GdWaveInterpreterFactory;
use WavesInterpreter\Factory\WaveInterpreter\ImagickWaveInterpreterFactory;


/**
 * Class WaveinterpreterFactoryTest
 * @package WavesInterpreter\Tests\Factory
 */
class WaveinterpreterFactoryTest extends \PHPUnit_Framework_TestCase
{

	public function testGDWaveInterpreterFactory()
	{
		$waveInterpreterFactory = GdWaveInterpreterFactory::getInstance();

		$this->assertInstanceOf(
		     'WavesInterpreter\Interpreter\Gd\GdWaveInterpreter'
			     , $waveInterpreterFactory->createWaveInterpreter()
		);

	}

	public function testImagickWaveInterpreterFactory()
	{
		$waveInterpreterFactory = ImagickWaveInterpreterFactory::getInstance();

		$this->assertInstanceOf(
		     'WavesInterpreter\Interpreter\Imagick\ImagickWaveInterpreter'
			     , $waveInterpreterFactory->createWaveInterpreter()
		);

	}

}