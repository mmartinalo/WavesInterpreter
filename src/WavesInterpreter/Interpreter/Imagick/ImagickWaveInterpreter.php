<?php

namespace WavesInterpreter\Interpreter\Imagick;

use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class ImagickWaveInterpreter
 * @package WavesInterpreter\Interpreter\Imagick
 */
class ImagickWaveInterpreter extends AbstractWaveInterpreter{


    private $binarizedColrosCache = array();

    /**
     * @param string
     * @return \Imagick
     */
    protected function loadResource($resource)
    {
        return new \Imagick($resource);;
    }

    /**
     * Dada un recurso lo convierte a un array de colores binarizados.
     *
     * @param \Imagick $imagickImage
     *
     * @return ImageMetadata
     */
    protected function binarization($imagickImage)
    {

        $imgMetadata = new ImageMetadata();

        $imgWidth = $imagickImage->getimagewidth();
        $imgHeight = $imagickImage->getimageheight();

        $imgMetadata->setWidth($imgWidth);
        $imgMetadata->setHeight($imgHeight);

        for($w=0;$w<$imgWidth;$w++){
            for($h=0;$h<$imgHeight;$h++){
                $imgMetadata->addPixel($w, $h, $this->getColorBinarized($imagickImage->getimagepixelcolor($w,$h)));
            }
        }

        return $imgMetadata;
    }

    /**
     * Dado un color, nos devuelve el representante binarizado.
     * Como puede ser un proceso tedioso, cacheamos los colores para que no haya que recorrer el array
     * de binarizaciones para devoler el resultado
     * @param $rgb
     * @return mixed
     */
    private function getColorBinarized($rgb)
    {

        if(!count($this->binarizationColors)){
            return $rgb;
        }

        if(isset($this->binarizedColrosCache[$rgb])){
            return $this->binarizedColrosCache[$rgb];
        }

        $position = 0;
        while(isset($this->binarizationColors[$position]) && $rgb > $this->binarizationColors[$position]){
            $position++;
        }

        //Si no existe ese valor es que le tenemos que devolver el último
        $this->binarizedColrosCache[$rgb] = isset($this->binarizationColors[$position]) ?
            $this->binarizationColors[$position] :
            end($this->binarizationColors);

        return $this->binarizedColrosCache[$rgb];

    }
}