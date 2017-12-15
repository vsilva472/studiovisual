<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:26
 */

namespace Vinicius\Booglan\Readers;


abstract class Reader
{
    /**
     * @var String  $filepath   The full path of file to get contents
     */
    protected $filepath;

    /**
     * @var mixed $data   The extracted text
     */
    protected $data;

    /**
     * Reader constructor.
     * @param String $filepath
     */
    public function __construct(String $filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Returns the extracted data from file
     * @return  mixed
     */
    public function getData()
    {
        return $this->data;
    }
}