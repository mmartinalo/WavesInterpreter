<?php

namespace WavesInterpreter\Tests\ColorGuesser;

use WavesInterpreter\ColorGuesser\Strategy\DefinedColorStrategy;
use WavesInterpreter\ColorGuesser\Strategy\EasyGuesserWaveColorStrategy;
use WavesInterpreter\ColorGuesser\Strategy\MinGuesserWaveColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Class EasyColorTest
 * @package WavesInterpreter\Tests\ColorGuesser
 */
class MinColorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider imageMetadataProvider
     * @param ImageMetadata $imageMetadata
     */
	public function testGuesser(ImageMetadata $imageMetadata)
	{
        $strategy = new MinGuesserWaveColorStrategy();

        $this->assertEquals(67,$strategy->guessWaveColor($imageMetadata));
        $this->assertEquals(44,$strategy->guessWaveColor($imageMetadata));
        $this->assertEquals(55,$strategy->guessWaveColor($imageMetadata));
        $this->assertEquals(0,$strategy->guessWaveColor($imageMetadata));

        $strategy->resetGuessedColors();
        $this->assertEquals(67,$strategy->guessWaveColor($imageMetadata));

    }

    public function imageMetadataProvider()
    {
        $imageMetadata = new ImageMetadata();
        $imageMetadata->addPixel(0,0,55);
        $imageMetadata->addPixel(0,1,55);
        $imageMetadata->addPixel(0,2,44);
        $imageMetadata->addPixel(1,0,44);
        $imageMetadata->addPixel(1,1,55);
        $imageMetadata->addPixel(1,2,67);
        $imageMetadata->addPixel(2,0,44);
        $imageMetadata->addPixel(2,1,55);
        $imageMetadata->addPixel(2,2,55);


        return array(
            array(
                $imageMetadata
            )
        );
    }
}