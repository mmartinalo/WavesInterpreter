<?php


namespace WavesInterpreter\ColorGuesser\Strategy;


use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Class EasyGuesserWaveColorStrategy
 * @package WavesInterpreter\ColorGuesser\Strategy
 */
class EasyGuesserWaveColorStrategy extends AbstractGuesserColorStrategy{

    /**
     * @param ImageMetadata $image_metadata
     * @return mixed
     */
    function guess(ImageMetadata $image_metadata)
    {


        //Por repetición de casos, el número de pixeles que tiene una onda es parecido a la altura mas el ancho de la imagen
        $magic_number = $image_metadata->getHeight() + $image_metadata->getWidth();

        //Vamos a formar un array con la desviación de cada elemento al "número mágico"
        $smallest = array();
        foreach ($image_metadata->getColors() as $key_color => $num_repetitions) {

            //Si lo hemos adivinado antes pasamos de él
            if(in_array($key_color, $this->guessed_colors)){
                continue;
            }

            $smallest[$key_color] = abs($num_repetitions - $magic_number);
        }

        //Como pueden estar todos los colores comprobados devolvemos 0 en tal caso
        if(!count($smallest)){
            return 0;
        }

        //Lo ordenamos de menor a mayor, en la clave está el código del color
        asort($smallest);
        return key($smallest);


    }
}