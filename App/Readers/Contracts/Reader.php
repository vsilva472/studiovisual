<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:25
 */

namespace Vinicius\Booglan\Readers\Contracts;


interface Reader
{
    function getData();
    function open();
}