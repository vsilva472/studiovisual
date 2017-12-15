<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 15:22
 */

namespace StudioVisual\App\Dialects\Contracts;


interface Dialect
{
    /**
     * Check if a single word is a dialect preposition
     *
     * @param   String  $word
     * @return  mixed
     */
    public function isPreposition($word);

    /**
     * Check if a single word is a dialect verb
     *
     * @param   String  $word
     * @return  mixed
     */
    public function isVerb($word);

    /**
     * Check if a single word is a dialect verb was in first person
     *
     * @param   String  $word
     * @return  mixed
     */
    public function isFirsPersonVerb($word);

    /**
     * Iterates over an array of words and return the prepositions
     *
     * @param   array   $words
     * @return  array of verbs
     */
    public function extractPrepositions(array $words);

    /**
     * Iterates over an array of words and return the verbs
     *
     * @param   array   $words
     * @return  array of verbs
     */
    public function extractVerbs(array $words);

    /**
     * Iterates over an array of words and return the first person verbs
     *
     * @param   array   $words
     * @return  array of verbs
     */
    public function extractFirstPersonVerbs(array $words);

    /**
     * @param   array   $items
     * @param   String  $callback
     * @return  array
     */
    public function doFilter(array $items, $callback);
}