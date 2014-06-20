<?php


namespace WavesInterpreter\Interpreter\Gd;

use WavesInterpreter\Exception\WaveInterpreterException;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;
use WavesInterpreter\Wave\Point;

/**
 * Class GdWaveInterpreter
 * @package WavesInterpreter\Interpreter\Gd
 */
class GdWaveInterpreter extends AbstractWaveInterpreter{


    function interpret($resource)
    {

        $gd_image = $this->loadResource($resource);

        if(!is_resource($gd_image)){
            throw new WaveInterpreterException("No se leer el recurso que me has dado");
        }

        $img_width = imagesx($gd_image);
        $img_height = imagesy($gd_image);

        for($h=0;$h<$img_height;$h++){
            for($w=0;$w<$img_width;$w++){
                $rgb = ImageColorAt($gd_image, $w, $h);

                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                //todo mejorar esto de los colores...
                if($r == 0 && $g == 0 && $b == 0){
                   $this->wave->addPoint(new Point($h,$w));
                }


            }
        }

        return $this->wave;
    }

    /**
     * @param string
     * @return null|resource
     */
    private function loadResource($resource)
    {
        $img = null;

        switch($resource){
            case preg_match('.png',$resource) != false :
                $img = @imagecreatefrompng($resource);
                break;
            case preg_match('.jpeg',$resource) != false :
                $img = @imagecreatefromjpeg($resource);
                break;
            default:
                $img = @imagecreatefromstring($resource);
                break;
        }

        return $img;
    }
}