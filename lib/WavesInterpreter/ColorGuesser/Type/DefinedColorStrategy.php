<?php


namespace WavesInterpreter\ColorGuesser\Type;

use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Class DefinedColorStrategy
 * @package WavesInterpreter\ColorGuesser\Type
 */
class DefinedColorStrategy extends AbstractGuesserColorStrategy{

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

        //Si no existe el color que nos facilitaron devolvemos otro
       if(!array_key_exists($this->defined_color, $image_metadata->getColors())){
            //return array_rand($image_metadata->getColors());

           //Vamos a formar un array con la desviación de cada elemento al color definido en el constructor
           $smallest = array();
           foreach ($image_metadata->getColors() as $key => $i) {
               $smallest[$key] = abs($i - $this->defined_color);
           }

           //Lo ordenamos de menor a mayor, en la clave está el código del color
           asort($smallest);
           return key($smallest);
       }

       return $this->defined_color;
    }
}