<?php

namespace WavesInterpreter\Interpreter\Imagick;


use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class ImagickWaveInterpreter
 * @package WavesInterpreter\Interpreter\Imagick
 */
class ImagickWaveInterpreter extends AbstractWaveInterpreter{


    /**
     * Lee el recurso proporcionado
     *
     * @param string
     * @return resource
     */
    protected function loadResource($resource)
    {
        // TODO: Implement loadResource() method.
    }

    /**
     * Crea una ImageMetadata que será lo que sabemos interpretar de manera genérica para el recurso proporcionado
     *
     * @param $gdImage
     * @param null $waveColor
     * @return ImageMetadata
     */
    protected function binarization($gdImage, $waveColor = null)
    {
        // TODO: Implement createMetaData() method.
    }
}