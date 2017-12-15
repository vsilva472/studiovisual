<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:25
 */

namespace StudioVisual\App\Readers\Contracts;


interface Reader
{
    function getData();
    function open();
}