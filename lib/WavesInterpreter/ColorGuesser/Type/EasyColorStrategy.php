<?php


namespace WavesInterpreter\ColorGuesser\Type;

use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Class EasyColorStrategy
 * @package WavesInterpreter\ColorGuesser\Type
 */
class EasyColorStrategy extends AbstractGuesserColorStrategy{

    /** @var  int */
    protected $defined_color;

    public function __construct($color)
    {
        $this->defined_color = $color;
    }

    /**
     * @param ImageMetadata $image_metadata
     * @return mixed
     */
    function guessWaveColor(ImageMetadata $image_metadata)
    {
        //Tiene que tener los datos de la imagen ya cargados
        if(!count($image_metadata->getColors())){
            //throw new WaveException('No puedes pedirme un color de onda si no existe ningún color en la imagen!');
            return 0;
        }

        //Si no existe el color que nos facilitaron en el constructor devolvemos uno aleatorio
       if(!array_key_exists($this->defined_color, $image_metadata->getColors())){
           //todo devolver el entero que más se aproxime
           return array_rand($image_metadata->getColors());
       }

       return $this->defined_color;
    }
}