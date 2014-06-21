<?php


namespace WavesInterpreter\Interpreter\Gd;

use WavesInterpreter\Exception\WaveInterpreterException;
use WavesInterpreter\ImageMetadata;
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

        $image_metadata = $this->createMetaData($gd_image);

        $array_map = $image_metadata->getImageMap();
        $wave_color = $image_metadata->guessWaveColor();


        foreach($array_map as $x => $y_values){
            foreach($y_values as $y => $color){

                if($color == $wave_color){
                   $this->wave->addPoint(new Point($x,$y));
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
            case preg_match('/.png/i',$resource) != false :
                $img = @imagecreatefrompng($resource);
                break;
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
     * @param $gd_image
     * @return ImageMetadata
     */
    private function createMetaData($gd_image)
    {
        $img_metadata = new ImageMetadata();

        $img_width = imagesx($gd_image);
        $img_height = imagesy($gd_image);

        $img_metadata->setWidth($img_height);
        $img_metadata->setHeight($img_width);


        for($h=0;$h<$img_height;$h++){
            for($w=0;$w<$img_width;$w++){
                $rgb = ImageColorAt($gd_image, $w, $h);
                $img_metadata->addPixel($w, $h,$rgb);
            }
        }

        return $img_metadata;
    }
}