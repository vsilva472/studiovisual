<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:22
 */

require_once "vendor/autoload.php";

use StudioVisual\App\Readers\TxtReader\Reader as TxtReader;
use StudioVisual\App\Dialects\Booglan\Booglan;

$filepath = 'config/b.txt';
$TxtReader = new TxtReader($filepath);

$words = trim($TxtReader->getData());
$words = explode(' ', $words);

$Booglan = new Booglan();

$prepositions = $Booglan->extractPrepositions($words);
$prepositions_count = count($prepositions);

$verbs = $Booglan->extractVerbs($words);
$verbs_count = count($verbs);

$fpVerbs = $Booglan->extractFirstPersonVerbs($verbs);
$fpVerbs_count = count($fpVerbs);

$wordsValues = $Booglan->extractValuesFromWordList($words);
$beautifullValues = $Booglan->extractBeautifulNumbers($wordsValues);

$uniqueBefautifulNumbers = array_unique($beautifullValues);
$uniqueBefautifulNumbers_count = count( $uniqueBefautifulNumbers );

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

        <li>
            <h3>Quantos verbos existem no texto B?</h3>
            <p>R: <?php print $verbs_count; ?></p>
        </li>

        <li>
            <h3>Quantos verbos existentes no texto B estão em primeira pessoa?</h3>
            <p>R: <?php print $fpVerbs_count; ?></p>
        </li>

        <li>
            <h3>Quantos números bonitos <em>distintos</em> existem no texto B?</h3>
            <p>R: <?php print $uniqueBefautifulNumbers_count; ?></p>
        </li>
    </ol>
</body>
</html>



