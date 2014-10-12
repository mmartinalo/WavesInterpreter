<?php


namespace WavesInterpreter\ColorGuesser\Strategy;

use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Estrategia de "adivinación" a la cual se le indica cual es el color de la onda
 *
 * Class DefinedColorStrategy
 * @package WavesInterpreter\ColorGuesser\Strategy
 */
class DefinedColorStrategy extends AbstractGuesserColorStrategy{

    /** @var  int */
    protected $definedColor;

    public function __construct($color)
    {
        $this->definedColor = $color;
    }

    /**
     * @param ImageMetadata $imageMetadata
     * @return mixed
     */
    function guess(ImageMetadata $imageMetadata)
    {

        //Si no existe el color que nos facilitaron devolvemos otro
       if(!array_key_exists($this->definedColor, $imageMetadata->getColors())){
            //return array_rand($image_metadata->getColors());

           //Vamos a formar un array con la desviación de cada elemento al color definido en el constructor
           $closest = array();
           foreach ($imageMetadata->getColors() as $keyColor => $numRepetitions) {

               //Si lo hemos adivinado antes pasamos de él
               if(in_array($keyColor, $this->guessedColors)){
                   continue;
               }

               $closest[$keyColor] = abs($keyColor - $this->definedColor);
           }

           //Como pueden estar todos los colores comprobados devolvemos 0 en tal caso
           if(!count($closest)){
               return 0;
           }

           //Lo ordenamos de menor a mayor, en la clave está el código del color
           asort($closest);
           return key($closest);
       }

       return $this->definedColor;
    }
}