<?php
/**
 * Created by PhpStorm.
 * User: mmartinalo
 * Date: 22/06/14
 * Time: 14:32
 */

namespace WavesInterpreter\Validator\Simple;


use WavesInterpreter\Validator\AbstractWaveValidator;
use WavesInterpreter\Wave\AbstractWave;

class SimpleWaveValidator extends AbstractWaveValidator{

    function validate(AbstractWave $wave)
    {
        // TODO: Implement validate() method.

        return true;
    }
}