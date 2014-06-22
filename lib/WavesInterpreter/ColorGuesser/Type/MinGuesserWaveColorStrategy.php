<?php
/**
 * Created by PhpStorm.
 * User: mmartinalo
 * Date: 22/06/14
 * Time: 17:22
 */

namespace WavesInterpreter\ColorGuesser\Type;


use WavesInterpreter\ColorGuesser\AbstractGuesserColorStrategy;
use WavesInterpreter\ImageMetadata;

class MinGuesserWaveColorStrategy extends AbstractGuesserColorStrategy{

    /**
     * @param ImageMetadata $image_metadata
     * @return mixed
     */
    function guessWaveColor(ImageMetadata $image_metadata)
    {
        if(!count($image_metadata->getColors())){
            return 0;
        }

        $selected_key = $min_repetitions = null;
        foreach($image_metadata->getColors() as $key => $repetitions){
            if(is_null($selected_key)){
                $selected_key = $key;
                $min_repetitions = $repetitions;
                continue;
            }

            if($min_repetitions > $repetitions){
                $selected_key = $key;
                $min_repetitions = $repetitions;
            }
        }

        return $selected_key;
    }
}