<?php

namespace WavesInterpreter\Tests\Interpreter;
use WavesInterpreter\Interpreter\Gd\GdWaveInterpreter;


/**
 * Class GDInterpreterTest
 * @package WavesInterpreter\Tests\Interpreter
 */
class GDInterpreterTest extends \PHPUnit_Framework_TestCase
{

    public function setUp(){
        if (!extension_loaded('gd')) {
            $this->markTestSkipped(
                'El módulo gd no está activo.'
            );
        }
    }

    public function testCreateWave(){

        $interpreter = new GdWaveInterpreter();

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

        $interpreter = new GdWaveInterpreter();
        $interpreter->createWave(null);

    }

}