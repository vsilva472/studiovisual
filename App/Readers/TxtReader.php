<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:27
 */

namespace Vinicius\Booglan\Readers;

use Vinicius\Booglan\Readers\Reader as AbstractReader;
use Vinicius\Booglan\Readers\Contracts\Reader as iReader;

class TxtReader extends AbstractReader implements iReader
{

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