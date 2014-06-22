<?php

namespace WavesInterpreter\Interpreter;

use WavesInterpreter\Factory\Wave\SimpleWaveFactory;
use WavesInterpreter\Factory\WaveAbstractFactory;
use WavesInterpreter\Factory\WaveInterpreter\HashMapWaveFactory;
use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Wave\AbstractWave;
use WavesInterpreter\Wave\Point;

/**
 * Class AbstractWaveInterpreter
 * @package WavesInterpreter\Interpreter
 */
abstract class AbstractWaveInterpreter {

    /** @var  WaveAbstractFactory */
    protected  $wave_factory;

    public function __construct($type = 'Simple')
    {
        $this->wave_factory =($type == 'Simple') ?
            SimpleWaveFactory::getInstance()
            :
            HashMapWaveFactory::getInstance();
    }

    /**
     * 1 - Leer recurso
     * 2 - Ccrear ImageMap
     * 3 - Adivinar color de la onda
     * 4 - Crear onda desde ImageMap
     * 5 - Validar onda
     * 6 - return Onda
     *
     * @param $resource
     * @return AbstractWave
     */
    abstract function createWave($resource);

    /**
     * @param ImageMetadata $image_metadata
     * @return AbstractWaveInterpreter|\WavesInterpreter\Wave\AbstractWave
     */
    protected function createWaveFromMetadata(ImageMetadata $image_metadata)
    {
        $array_map = $image_metadata->getImageMap();
        $wave_color = $image_metadata->guessWaveColor();

        $wave = $this->wave_factory->createWave();

        foreach($array_map as $x => $y_values){
            foreach($y_values as $y => $color){

                if($color == $wave_color){
                    $wave->addPoint(new Point($x,$y));
                }


            }
        }

        return $wave;
    }

} 