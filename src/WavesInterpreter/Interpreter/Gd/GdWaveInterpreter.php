<?php


namespace WavesInterpreter\Interpreter\Gd;

use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class GdWaveInterpreter
 * @package WavesInterpreter\Interpreter\Gd
 */
class GdWaveInterpreter extends AbstractWaveInterpreter{

    const MAX_COLOR_VALUE = 16777215;

    private $binarizedColrosCache = array();

    /**
     * @param string
     * @return resource
     */
    protected function loadResource($resource)
    {
        $img = null;

        switch($resource){
            case preg_match('/.png/i',$resource) != false :
                $img = @imagecreatefrompng($resource);
                break;
            case preg_match('/.jpg/i',$resource) != false :
            case preg_match('/.jpeg/i',$resource) != false :
            $img = @imagecreatefromjpeg($resource);
                break;
            default:
                $img = @imagecreatefromstring($resource);
                break;
        }

        return $img;
    }

    /**
     * Dada un recurso lo convierte a un array de colores binarizados.
     *
     * @param $gdImage
     *
     * @return ImageMetadata
     */
    protected function binarization($gdImage)
    {

        $imgMetadata = new ImageMetadata();

        $imgWidth = imagesx($gdImage);
        $imgHeight = imagesy($gdImage);

        $imgMetadata->setWidth($imgWidth);
        $imgMetadata->setHeight($imgHeight);

        //la librería gd_image coge como coordenada 0,0 la esquina superior izquierda
        //Nosortos queremos la inferior izquiera, por lo que a las y le tenemos que coger el valor inverso al obtenido
        //Para las x nos da igual, ya que lo comparten
        for($w=0;$w<$imgWidth;$w++){
            for($h=0;$h<$imgHeight;$h++){
                $rgb = ImageColorAt($gdImage, $w, $h);
                $realY = $imgHeight - $h -1; //-1 ya que recorremos el array con < en lugar de <= ya que nos salidríamos de la imagen
                $imgMetadata->addPixel($w, $realY, $this->getColorBinarized($rgb));
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

        //Si no tenemos generado un array con el conjunto de colores que queremos devolvemos el mismo color
        if(!count($this->binarizationColors)){
            return $rgb;
        }

        if(isset($this->binarizedColrosCache[$rgb])){
            return $this->binarizedColrosCache[$rgb];
        }

        //Vamos recorriendo el array de colores ordenado de menor a mayor hasta encontrar con cual se corresponde
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

    /**
     * Para una correcta binarización tenemos que saber el rango máximo del valor de un color
     *
     * @return mixed
     */
    protected function getMaxColorValue()
    {
        return self::MAX_COLOR_VALUE;
    }
}