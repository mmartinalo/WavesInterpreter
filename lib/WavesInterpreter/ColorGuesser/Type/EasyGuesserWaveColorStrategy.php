<?php


namespace WavesInterpreter\ColorGuesser\Type;


use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

class EasyGuesserWaveColorStrategy extends AbstractGuesserColorStrategy{

    /**
     * @param ImageMetadata $image_metadata
     * @return mixed
     */
    function guessWaveColor(ImageMetadata $image_metadata)
    {

        if(!count($image_metadata->getColors())){
            return 0;
        }

        //Por repetición de casos, el número de pixeles que tiene una onda es parecido a la altura mas el ancho de la imagen
        $magic_number = $image_metadata->getHeight() + $image_metadata->getWidth();

        //Vamos a formar un array con la desviación de cada elemento al "número mágico"
        $smallest = array();
        foreach ($image_metadata->getColors() as $key => $i) {
            $smallest[$key] = abs($i - $magic_number);
        }

        //Lo ordenamos de menor a mayor, en la clave está el código del color
        asort($smallest);
        return key($smallest);


    }
}