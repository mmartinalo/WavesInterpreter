<?php


namespace WavesInterpreter\Interpreter\Gd;

use WavesInterpreter\ColorGuesser\Type\DefinedColorStrategy;
use WavesInterpreter\Exception\WaveInterpreterException;
use WavesInterpreter\ImageMetadata;
use WavesInterpreter\Interpreter\AbstractWaveInterpreter;
use WavesInterpreter\Wave\Proxy\ProxyWave;

/**
 * Class GdWaveInterpreter
 * @package WavesInterpreter\Interpreter\Gd
 */
class GdWaveInterpreter extends AbstractWaveInterpreter{


    /**
     * @param $resource
     * @param null $wave_color
     * @throws \WavesInterpreter\Exception\WaveInterpreterException
     * @return AbstractWaveInterpreter|\WavesInterpreter\Wave\AbstractWave
     */
    function createWave($resource, $wave_color = null)
    {

        $gd_image = $this->loadResource($resource);

        if(!is_resource($gd_image)){
            throw new WaveInterpreterException("No se leer el recurso que me has dado");
        }

        $image_metadata = $this->createMetaData($gd_image, $wave_color);

        $wave = $this->createWaveFromMetadata($image_metadata);

        $validator = $this->wave_factory->createValidator();

        if(!$validator->validate($wave)){
            //todo que hacemos? volvemos a intentar con otro color?
            return null;
        }

        return new ProxyWave($wave);
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
    private function createMetaData($gd_image, $wave_color = null)
    {
        //En caso de que nos pasen un color le establecemos la estrategia del adivinador correspondiente
        $guesser = ($wave_color)? new DefinedColorStrategy($wave_color) : null;
        $img_metadata = new ImageMetadata($guesser);

        $img_width = imagesx($gd_image);
        $img_height = imagesy($gd_image);

        $img_metadata->setWidth($img_width);
        $img_metadata->setHeight($img_height);


        for($h=0;$h<$img_height;$h++){
            for($w=0;$w<$img_width;$w++){
                $rgb = ImageColorAt($gd_image, $w, $h);
                $img_metadata->addPixel($w, $h,$rgb);
            }
        }

        return $img_metadata;
    }
}