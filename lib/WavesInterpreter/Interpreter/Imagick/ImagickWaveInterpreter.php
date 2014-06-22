<?php

namespace WavesInterpreter\Interpreter\Imagick;


use WavesInterpreter\Interpreter\AbstractWaveInterpreter;
use WavesInterpreter\Wave\AbstractWave;

/**
 * Class ImagickWaveInterpreter
 * @package WavesInterpreter\Interpreter\Imagick
 */
class ImagickWaveInterpreter extends AbstractWaveInterpreter{


    /**
     * 1 - Leer recurso
     * 2 - Ccrear ImageMap
     * 3 - Adivinar color de la onda
     * 4 - Crear onda desde ImageMap
     * 5 - Validar onda
     * 6 - return Onda
     *
     * @param $resource
     * @param null $wave_color
     * @return AbstractWave
     */
    function createWave($resource, $wave_color = null)
    {
        // TODO: Implement createWave() method.
    }
}