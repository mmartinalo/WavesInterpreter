<?php

namespace WavesInterpreter\Tests\Validator;

use WavesInterpreter\Point\Point;
use WavesInterpreter\Point\PointCollection\HashMapPointCollection\HashMapPointCollection;
use WavesInterpreter\Point\PointCollection\SimplePointCollection\SimplePointCollection;
use WavesInterpreter\Validator\Complex\ComplexWaveValidator;
use WavesInterpreter\Validator\Simple\SimpleWaveValidator;
use WavesInterpreter\Wave\Complex\ComplexWave;
use WavesInterpreter\Wave\Simple\SimpleWave;


/**
 * Class ComplexWaveValidatorTest
 * @package WavesInterpreter\Tests\Validator
 */
class ComplexWaveValidatorTest extends \PHPUnit_Framework_TestCase
{

    /** @var  ComplexWaveValidator */
    protected $validator;

    public function setUp(){
        $this->validator = new ComplexWaveValidator();
    }
    /**
     * @expectedException \WavesInterpreter\Exception\WaveValidatorException
     */
    public function testType()
    {
        $this->validator->validate(new SimpleWave(new SimplePointCollection()));
    }


    public function testEmptyWave()
    {
        $wave = new ComplexWave(new SimplePointCollection());
        $this->assertFalse($this->validator->validate($wave));

    }

    /**
     * @dataProvider smallCollectionProvider
     * @param $collectionSmall
     */
    public function testSmallWave($collectionSmall)
    {
        $wave = new ComplexWave($collectionSmall);
        $this->assertFalse($this->validator->validate($wave));
    }

    /**
     * @dataProvider smallCollectionProvider
     * @param noContinuedCollectionProvider
     */
    public function testNoContinuedWave($collectionNoContinued)
    {
        $wave = new ComplexWave($collectionNoContinued);
        $this->assertFalse($this->validator->validate($wave));
    }

    /**
     * @dataProvider backCollectionProvider
     * @param $collectionBack
     */
    public function testBacklWave($collectionBack)
    {
        $wave = new ComplexWave($collectionBack);
        $this->assertFalse($this->validator->validate($wave));
    }

    /**
     * @dataProvider validCollectionProvider
     * @param $collectionValid
     */
    public function testValidWave($collectionValid)
    {
        $wave = new ComplexWave($collectionValid);
        $this->assertTrue($this->validator->validate($wave));
    }

    public function smallCollectionProvider(){
        $collection = new SimplePointCollection();
        $collection->addPoint(new Point(0,0));
        $collection->addPoint(new Point(1,0));
        $collection->addPoint(new Point(2,0));

        return array(
            array(
                $collection
            )
        );
    }

    public function noContinuedCollectionProvider(){
        $collection = new SimplePointCollection();
        $collection->addPoint(new Point(0,0));
        $collection->addPoint(new Point(1,0));
        $collection->addPoint(new Point(2,0));
        $collection->addPoint(new Point(3,0));
        $collection->addPoint(new Point(4,0));
        $collection->addPoint(new Point(10,0));
        $collection->addPoint(new Point(11,0));
        $collection->addPoint(new Point(12,0));
        $collection->addPoint(new Point(13,0));
        $collection->addPoint(new Point(14,0));
        $collection->addPoint(new Point(15,0));

        return array(
            array(
                $collection
            )
        );
    }

    public function backCollectionProvider(){
        $collection = new SimplePointCollection();
        $collection->addPoint(new Point(0,0));
        $collection->addPoint(new Point(1,0));
        $collection->addPoint(new Point(2,0));
        $collection->addPoint(new Point(3,0));
        $collection->addPoint(new Point(4,1));
        $collection->addPoint(new Point(5,1));
        $collection->addPoint(new Point(6,2));
        $collection->addPoint(new Point(5,3));
        $collection->addPoint(new Point(4,3));
        $collection->addPoint(new Point(3,4));
        $collection->addPoint(new Point(2,4));

        return array(
            array(
                $collection
            )
        );
    }

    public function validCollectionProvider(){
        $collection = new SimplePointCollection();
        $collection->addPoint(new Point(0,0));
        $collection->addPoint(new Point(1,0));
        $collection->addPoint(new Point(2,0));
        $collection->addPoint(new Point(3,0));
        $collection->addPoint(new Point(4,1));
        $collection->addPoint(new Point(5,1));
        $collection->addPoint(new Point(6,2));
        $collection->addPoint(new Point(7,3));
        $collection->addPoint(new Point(8,3));
        $collection->addPoint(new Point(9,4));
        $collection->addPoint(new Point(10,4));

        return array(
            array(
                $collection
            )
        );
    }
}
