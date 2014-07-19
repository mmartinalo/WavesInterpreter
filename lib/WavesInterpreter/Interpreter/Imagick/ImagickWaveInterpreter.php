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
     * @param $gd_image
     * @param null $wave_color
     * @return ImageMetadata
     */
    protected function createMetaData($gd_image, $wave_color = null)
    {
        // TODO: Implement createMetaData() method.
    }
}