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
     * @param $gd_image
     * @param null $wave_color
     * @return ImageMetadata
     */
    protected function createMetaData($gd_image, $wave_color = null)
    {
        //En caso de que nos pasen un color le establecemos la estrategia del adivinador correspondiente
        $guesser = ($wave_color)? new DefinedColorStrategy($wave_color) : null;
        $img_metadata = new ImageMetadata($guesser);

        $img_width = imagesx($gd_image);
        $img_height = imagesy($gd_image);

        $img_metadata->setWidth($img_width);
        $img_metadata->setHeight($img_height);

        //la librería gd_image coge como coordenada 0,0 la esquina superior izquierda
        //Nosortos queremos la inferior izquiera, por lo que a las y le tenemos que coger el valor inverso al obtenido
        //Para las x nos da igual, ya que lo comparten
        for($w=0;$w<$img_width;$w++){
            for($h=0;$h<$img_height;$h++){
                $rgb = ImageColorAt($gd_image, $w, $h);
                $real_y = $img_height - $h -1; //-1 ya que recorremos el array con < en lugar de <= ya que nos salidríamos de la imagen
                $img_metadata->addPixel($w, $real_y, $rgb);
            }
        }

        return $img_metadata;
    }
}