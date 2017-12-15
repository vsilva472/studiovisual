<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 13:31
 */

namespace StudioVisual\App\Dialects\Booglan;

use StudioVisual\App\Dialects\Dialect;
use StudioVisual\App\Dialects\Contracts\Dialect as iDialect;

class Booglan extends Dialect implements iDialect
{
    /**
     * @var array $fooLetters;
     */
    protected $fooLetters;

    /**
     * @var array $barLetters
     */
    protected $barLetters;

    /**
     * Booglan constructor.
     */
    public function __construct()
    {
        parent::__construct('twhzkdfvcjxlrnqmgpsb');
        $this->fooLetters = array( 'r', 't', 'c', 'd', 'b' );
        $this->barLetters = array_diff($this->alphabet, $this->fooLetters);
    }

    /**
     * Check if a single word ends with one of bar letters
     *
     * @param   String  $word
     * @return bool
     */
    private function isWordEndingWithBarLetter($word) {
        $word_length    = strlen($word);
        $last_char      = $word[$word_length - 1];

        return in_array($last_char, $this->barLetters);
    }

    /**
     * Check if a single word is a dialect preposition
     *
     * @param   String $word
     * @return  boolean
     */
    public function isPreposition($word)
    {
        return (strlen($word) === 5 && $this->isWordEndingWithBarLetter($word) && strpos($word,'l') === false);
    }

    /**
     * Check if a single word is a dialect verb
     *
     * @param   String $word
     * @return  boolean
     */
    public function isVerb($word)
    {
        return (strlen($word) >= 8 && $this->isWordEndingWithBarLetter($word));
    }

    /**
     * Check if a single word is a dialect verb was in first person
     *
     * @param   String $word
     * @return  boolean
     */
    public function isFirsPersonVerb($word)
    {
        return ($this->isVerb($word) && in_array($word[0], $this->barLetters));
    }

    /**
     * Iterates over an array of words and return the prepositions
     *
     * @param   array   $words
     * @return  array of verbs
     */
    public function extractPrepositions(array $words)
    {
        return $this->doFilter($words, 'isPreposition');
    }

    /**
     * Iterates over an array of words and return the verbs
     *
     * @param   array $words
     * @return  array of verbs
     */
    public function extractVerbs(array $words)
    {
        return $this->doFilter($words, 'isVerb');
    }

    /**
     * Iterates over an array of words and return the first person verbs
     *
     * @param   array $words
     * @return  array of verbs
     */
    public function extractFirstPersonVerbs(array $words)
    {
        return $this->doFilter($words, 'isFirsPersonVerb');
    }

    /**
     * @param   array $words
     * @param   String $callback
     * @return  array
     */
    public function doFilter(array $words, $callback)
    {
        return array_filter($words, array($this, $callback));
    }
}