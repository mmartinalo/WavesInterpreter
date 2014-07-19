<?php


namespace WavesInterpreter\ColorGuesser;

use WavesInterpreter\ImageMetadata;

/**
 * Class AbstractGuesserColorStrategy
 * @package WavesInterpreter\ColorGuesser
 */
abstract class AbstractGuesserColorStrategy {

    /** @var array Guardaremos los colores ya usados */
    protected $guessed_colors = array();

    /**
     * @param ImageMetadata $image_metadata
     * @return int
     */
    public function guessWaveColor(ImageMetadata $image_metadata)
    {
        $this->initGuessWaveColor();

        if(!count($image_metadata->getColors())){
            return 0;
        }

        $this->preGuess();
        $selected_key = $this->guess($image_metadata);
        $this->postGuess();

        //No queremos añadirlo dos veces
        if(!in_array($selected_key, $this->guessed_colors)){
            $this->guessed_colors[] = $selected_key;
        }

        $this->finishGuessWaveColor();

        return $selected_key;
    }

    abstract function guess(ImageMetadata $image_metadata);


    /** Se llama al inicio del método GuessWaveColor */
    protected function initGuessWaveColor(){}

    /** Se llama al final del método GuessWaveColor */
    protected function finishGuessWaveColor(){}

    /** Se llama antes de llamar al método guess*/
    protected function preGuess(){}

    /** Se llama después de llamar al método guess*/
    protected function postGuess(){}


    /**
     *  Pone a cero los colores que ya hubiera adivinado
     */
    public function resetGuessedColors()
    {
        $this->guessed_colors = array();
    }
} 