<?php


namespace WavesInterpreter\Interpreter\Gd;

use WavesInterpreter\ColorGuesser\Strategy\DefinedColorStrategy;
use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;

/**
 * Class GdWaveInterpreter
 * @package WavesInterpreter\Interpreter\Gd
 */
class GdWaveInterpreter extends AbstractWaveInterpreter{


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
                $img = @imagecreatefromjpeg($resource);
                break;
            default:
                $img = @imagecreatefromstring($resource);
                break;
        }

        return $img;
    }

    /**
     * @param $gdImage
     * @param null $waveColor
     * @return ImageMetadata
     */
    protected function binarization($gdImage, $waveColor = null)
    {
        //En caso de que nos pasen un color le establecemos la estrategia del adivinador correspondiente
        $guesser = ($waveColor)? new DefinedColorStrategy($waveColor) : null;
        $imgMetadata = new ImageMetadata($guesser);

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
                $imgMetadata->addPixel($w, $realY, $rgb);
            }
        }

        return $imgMetadata;
    }
}