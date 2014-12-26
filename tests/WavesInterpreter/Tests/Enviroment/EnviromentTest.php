<?php

namespace WavesInterpreter\Tests\Enviroment;

use WavesInterpreter\Factory\WaveInterpreter\GdWaveInterpreterFactory;
use WavesInterpreter\Factory\WaveInterpreter\ImagickWaveInterpreterFactory;


/**
 * Class EnviromentTest
 * @package WavesInterpreter\Tests\Enviroment
 */
class EnviromentTest extends \PHPUnit_Framework_TestCase
{

	public function testGD()
	{
		$this->assertTrue(extension_loaded('gd'));

	}

	public function testImagick()
	{
		$this->assertTrue(extension_loaded('imagick'));

	}

}