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
     * @return  bool
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
     * Check if a given number is a beautiful number with base on Booglan rules
     *
     * @param   int $number
     * @return  bool
     */
    public function isBeautifulNumber($number)
    {
        return (($number >= 422224) && ($number % 3 == 0));
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
     * Extract de value from a give word with base on Booglan rules
     *
     * @param   string  $word
     * @return  int
     */
    public function extractWordValue($word)
    {
        $value      = 0;
        $letters    = str_split($word);

        foreach($letters as $key => $letter) $value += $this->getLetterValue($letter) * (pow(20, $key));

        return $value;
    }

    /**
     * Get a value of a letter with base on Booglan alphabet
     *
     * Note: if a letter of word is not a valid Booglan letter this letter will be ignored
     *
     * @param   String  $letter
     * @return  int
     */
    private function getLetterValue($letter)
    {
        $value = array_search($letter, $this->alphabet);

        if (!is_numeric($value)) return 0;

        return $value;
    }

    /**
     * Iterates over an array of numbers and returns
     * a new array only with booglan beautiful numbers
     *
     * @param   array   $numbers
     * @return  array of verbs
     */
    public function extractBeautifulNumbers(array $numbers)
    {
        return $this->doFilter($numbers, 'isBeautifulNumber');
    }

    /**
     * Iterates over an array of words and returns
     * a new array with each word value
     *
     * @param   array   $words
     * @return  array
     */
    public function extractValuesFromWordList(array $words)
    {
        return array_map(array($this, 'extractWordValue'), $words);
    }

    /**
     * Iterates over a list and apply some logic via callback
     *
     * @param   array   $items
     * @param   String  $callback
     * @return  array
     */
    public function doFilter(array $items, $callback)
    {
        return array_filter($items, array($this, $callback));
    }

    /**
     * Sort ASC a given list
     *
     * @param   array   $list
     * @return  array
     */
    public function doSort(array $list)
    {
        usort($list, array($this, 'strCmp'));
        return $list;
    }

    /**
     * Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal.
     *
     * Note: This function is similar to native php strcmp, but with Booglan alphabet rules
     *
     * @param   String  $str1
     * @param   String  $str2
     * @return  int
     */
    private function strCmp($str1, $str2)
    {
        $index          = 0;
        $str1_len       = strlen($str1);
        $str2_len       = strlen($str2);
        $lower_length   = min($str1_len, $str2_len);

        while ($index < $lower_length)
        {
            $str1_letter_val = $this->getLetterValue($str1[$index]);
            $str2_letter_val = $this->getLetterValue($str2[$index]);

            if ($str1_letter_val > $str2_letter_val) return 1;
            if ($str2_letter_val > $str1_letter_val) return -1;

            $index++;
        }

        if ($str1_len > $str2_len) return 1;
        if ($str2_len > $str1_len) return -1;

        return 0;
    }
}