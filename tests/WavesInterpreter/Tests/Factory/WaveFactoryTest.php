<?php

namespace WavesInterpreter\Tests\Factory;

use WavesInterpreter\Factory\Wave\ComplexWaveFactory;
use WavesInterpreter\Factory\Wave\SimpleWaveFactory;

/**
 * Class SimpleCollectionFactoryTest
 * @package WavesInterpreter\Tests\Factory
 */
class WaveFactoryTest extends \PHPUnit_Framework_TestCase
{



	public function testSimpleWaveFactory()
	{
		$waveFactory = SimpleWaveFactory::getInstance();

		$this->assertInstanceOf(
		     'WavesInterpreter\Wave\Simple\SimpleWave',
             $waveFactory->createWave()
		);
		$this->assertInstanceOf(
		     'WavesInterpreter\Validator\Simple\SimpleWaveValidator',
             $waveFactory->createValidator()
		);

	}

	public function testComplexWaveFactory()
	{
		$waveFactory = ComplexWaveFactory::getInstance();

		$this->assertInstanceOf(
		     'WavesInterpreter\Wave\Complex\ComplexWave',
             $waveFactory->createWave()
		);
		$this->assertInstanceOf(
		     'WavesInterpreter\Validator\Complex\ComplexWaveValidator',
             $waveFactory->createValidator()
		);

	}

    /**
     * @expectedException \Exception
     */
    public function testSingletonSimpleFactory()
    {
        $waveFactory = SimpleWaveFactory::getInstance();
        $f = clone $waveFactory;
    }

    /**
     * @expectedException \Exception
     */
    public function testSingletonComplexFactory()
    {
        $waveFactory = ComplexWaveFactory::getInstance();
        $f = clone $waveFactory;
    }

}