<?php


namespace WavesInterpreter\ColorGuesser;

use WavesInterpreter\ImageMetadata;

/**
 * Class AbstractGuesserColorStrategy
 * @package WavesInterpreter\ColorGuesser
 */
abstract class AbstractGuesserColorStrategy {

    /** @var array Guardaremos los colores ya usados */
    protected $guessedColors = array();

    /**
     * Fase de adivinación del color de onda
     *
     * @param ImageMetadata $imageMetadata
     * @return int
     */
    public function guessWaveColor(ImageMetadata $imageMetadata)
    {
        $this->initGuessWaveColor();

        if(!count($imageMetadata->getColors())){
            return 0;
        }

        $this->preGuess();
        $selectedKey = $this->guess($imageMetadata);
        $this->postGuess();

        //No queremos añadirlo dos veces
        if(!in_array($selectedKey, $this->guessedColors)){
            $this->guessedColors[] = $selectedKey;
        }

        $this->finishGuessWaveColor();

        return $selectedKey;
    }

    abstract function guess(ImageMetadata $imageMetadata);


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
        $this->guessedColors = array();
    }
} 