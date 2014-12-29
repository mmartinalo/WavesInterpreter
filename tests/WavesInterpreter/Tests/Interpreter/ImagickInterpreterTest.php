<?php

namespace WavesInterpreter\Tests\Interpreter;
use WavesInterpreter\Interpreter\Imagick\ImagickWaveInterpreter;


/**
 * Class ImagickInterpreterTest
 * @package WavesInterpreter\Tests\Interpreter
 */
class ImagickInterpreterTest extends \PHPUnit_Framework_TestCase
{

    public function setUp(){
        if (!extension_loaded('imagick')) {
            $this->markTestSkipped(
                'El módulo imagick no está activo.'
            );
        }
    }

    public function testCreateWave(){

        $interpreter = new ImagickWaveInterpreter();

        $this->assertInstanceOf(
            'WavesInterpreter\Wave\Proxy\ProxyWave',
             $interpreter->createWave(__DIR__.'/../../../resources/bloqueoAV.jpg')
        );

        $this->assertInstanceOf(
            'WavesInterpreter\Wave\Proxy\ProxyWave',
            $interpreter->createWave(__DIR__.'/../../../resources/hipocalcemia.png')
        );

    }

    /**
     * @expectedException \Exception
     */
    public function testNoResource(){

        $interpreter = new ImagickWaveInterpreter();
        $interpreter->createWave(null);

    }

}