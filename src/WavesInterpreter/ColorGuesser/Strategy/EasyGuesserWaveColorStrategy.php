<?php


namespace WavesInterpreter\ColorGuesser\Strategy;


use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Por empirismo, el número de pixeles de la onda es próximo al alto más ancho de la imagen.
 * Esta estrategia de adivinación devuelve el color que más se aproxime a este número
 *
 * Class EasyGuesserWaveColorStrategy
 * @package WavesInterpreter\ColorGuesser\Strategy
 */
class EasyGuesserWaveColorStrategy extends AbstractGuesserColorStrategy{

    /**
     * @param ImageMetadata $imageMetadata
     * @return mixed
     */
    protected function guess(ImageMetadata $imageMetadata)
    {


        //Por repetición de casos, el número de pixeles que tiene una onda es parecido a la altura mas el ancho de la imagen
        $magicNumber = $imageMetadata->getHeight() + $imageMetadata->getWidth();

        //Vamos a formar un array con la desviación de cada elemento al "número mágico"
        $smallest = array();
        foreach ($imageMetadata->getColors() as $keyColor => $numRepetitions) {

            //Si lo hemos adivinado antes pasamos de él
            if(in_array($keyColor, $this->guessedColors)){
                continue;
            }

            $smallest[$keyColor] = abs($numRepetitions - $magicNumber);
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