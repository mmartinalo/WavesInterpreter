<?php


namespace WavesInterpreter\ColorGuesser\Strategy;

use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Class DefinedColorStrategy
 * @package WavesInterpreter\ColorGuesser\Strategy
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
    function guess(ImageMetadata $image_metadata)
    {

        //Si no existe el color que nos facilitaron devolvemos otro
       if(!array_key_exists($this->defined_color, $image_metadata->getColors())){
            //return array_rand($image_metadata->getColors());

           //Vamos a formar un array con la desviación de cada elemento al color definido en el constructor
           $closest = array();
           foreach ($image_metadata->getColors() as $key_color => $num_repetitions) {

               //Si lo hemos adivinado antes pasamos de él
               if(in_array($key_color, $this->guessed_colors)){
                   continue;
               }

               $closest[$key_color] = abs($key_color - $this->defined_color);
           }

           //Como pueden estar todos los colores comprobados devolvemos 0 en tal caso
           if(!count($closest)){
               return 0;
           }

           //Lo ordenamos de menor a mayor, en la clave está el código del color
           asort($closest);
           return key($closest);
       }

       return $this->defined_color;
    }
}