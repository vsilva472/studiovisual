<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:27
 */

namespace StudioVisual\App\Readers\TxtReader;

use StudioVisual\App\Readers\Reader as AbstractReader;
use StudioVisual\App\Readers\Contracts\Reader as iReader;

class Reader extends AbstractReader implements iReader
{

    /**
     * Reader constructor.
     * @param String $filepath
     */
    public function __construct($filepath)
    {
        parent::__construct($filepath);
        $this->open();
    }

    /**
     * Open file to extract data
     * @return void
     */
    public function open()
    {
        $this->data = @file_get_contents($this->filepath);
    }
}