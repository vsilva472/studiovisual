<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 16:23
 */

namespace StudioVisual\App\Dialects;


abstract class Dialect
{
    /**
     * @var array $alphabet
     */
    protected $alphabet;

    /**
     * Dialect constructor.
     * @param $alphabet
     */
    public function __construct($alphabet)
    {
        $this->alphabet = str_split($alphabet);
    }
}