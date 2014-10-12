<?php
/**
 * Created by PhpStorm.
 * User: mmartinalo
 * Date: 22/06/14
 * Time: 17:22
 */

namespace WavesInterpreter\ColorGuesser\Strategy;


use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

/**
 * Class MinGuesserWaveColorStrategy
 * @package WavesInterpreter\ColorGuesser\Strategy
 */
class MinGuesserWaveColorStrategy extends AbstractGuesserColorStrategy{

    /**
     * @param ImageMetadata $imageMetadata
     * @return mixed
     */
    function guess(ImageMetadata $imageMetadata)
    {

        $selected_key = $min_repetitions = null;
        foreach($imageMetadata->getColors() as $key_color => $num_repetitions){

            //Si lo hemos adivinado antes pasamos de él
            if(in_array($key_color, $this->guessedColors)){
                continue;
            }

            if(is_null($selected_key)){
                $selected_key = $key_color;
                $min_repetitions = $num_repetitions;
                continue;
            }

            if($min_repetitions > $num_repetitions){
                $selected_key = $key_color;
                $min_repetitions = $num_repetitions;
            }
        }

        if(!$selected_key){
            return 0;
        }

        return $selected_key;
    }
}