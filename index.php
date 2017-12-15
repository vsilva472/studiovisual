<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:22
 */

require_once "vendor/autoload.php";

use StudioVisual\App\Readers\TxtReader;
use StudioVisual\App\Dialetos\Booglan\Booglan;

$filepath = 'config/b.txt';
$TxtReader = new TxtReader( $filepath );

$data = trim($TxtReader->getData());

$Booglan = new Booglan( 'twhzkdfvcjxlrnqmgpsb' );
$prepositions_count = $Booglan->getPropositionCountFrom($data);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ol style="list-style: none;">
        <li>
            <h3>Quantas preposições existem no texto B?</h3>
            <p>R: <?php print $prepositions_count; ?></p>
        </li>
    </ol>
</body>
</html>



