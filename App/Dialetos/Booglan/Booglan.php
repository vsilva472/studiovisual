<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 13:31
 */

namespace StudioVisual\App\Dialetos\Booglan;

class Booglan
{
    private $alphabet;
    private $fooLetters;
    private $barLetters;
    private $text;

    public function __construct ($alphabet)
    {
        $this->alphabet = str_split($alphabet);
        $this->fooLetters = array( 'r', 't', 'c', 'd', 'b' );
        $this->setupBarLetters();
    }

    private function setupBarLetters ()
    {
        $this->barLetters = array_diff($this->alphabet, $this->fooLetters);
    }

    public function getPropositionCountFrom($txt)
    {
        $parts = explode( ' ', $txt );
        $prepositions = array_filter($parts, function ($word) {
            return (strlen($word) === 5 && in_array($word[4], $this->barLetters) && strpos(  $word,'l') === false);
        });

        return count($prepositions);
    }
}