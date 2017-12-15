<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:22
 */

require_once "vendor/autoload.php";

use \Vinicius\Booglan\Readers\TxtReader;

$filepath = 'config/a.txt';
$TxtReader = new TxtReader( $filepath );

echo $TxtReader->getData();