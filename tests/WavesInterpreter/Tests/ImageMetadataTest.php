<?php

namespace WavesInterpreter\Tests;

use WavesInterpreter\ImageMetadata;


/**
 * Class ImageMetadataTest
 * @package WavesInterpreter\Tests
 */
class ImageMetadataTest extends \PHPUnit_Framework_TestCase
{


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

    public function testAddPixel()
    {
        $imageMetadata = new ImageMetadata();
        $imageMetadata->addPixel(1,1,0);
        $this->assertCount(1,$imageMetadata->getColors());
        $this->assertTrue(isset($imageMetadata->getColors()[0]));
        $this->assertEquals(1,$imageMetadata->getColors()[0]);
        $this->assertCount(1,$imageMetadata->getImageMap());

        $imageMetadata->addPixel(1,1,1);
        $this->assertCount(1,$imageMetadata->getColors());
        $this->assertFalse(isset($imageMetadata->getColors()[0]));
        $this->assertCount(1,$imageMetadata->getImageMap());

        $imageMetadata->addPixel(2,1,0);
        $this->assertCount(2,$imageMetadata->getColors());
        $this->assertCount(2,$imageMetadata->getImageMap());

        $imageMetadata->addPixel(3,1,1);
        $this->assertCount(3,$imageMetadata->getImageMap());
        $this->assertCount(2,$imageMetadata->getColors());
        $this->assertEquals(2,$imageMetadata->getColors()[1]);


    }

    /**
     * @expectedException \Exception
     */
    public function testNoValidX()
    {
        $imageMetadata = new ImageMetadata();
        $imageMetadata->addPixel(-1,1,0);


    }

    /**
     * @expectedException \Exception
     */
    public function testNoValidY()
    {
        $imageMetadata = new ImageMetadata();
        $imageMetadata->addPixel(1,-1,0);


    }

}