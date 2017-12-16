<?php
/**
 * Created by PhpStorm.
 * User: vinicius
 * Date: 15/12/2017
 * Time: 12:22
 */

/*---------------- AREA EDITÁVEL ---------------------*/

// troque de b.txt para a.txt para ver as respostas controle.
$filepath = 'config/b.txt';

/*------------- FIM DA AREA EDITÁVEL ------------------*/

require_once "vendor/autoload.php";

use StudioVisual\App\Readers\TxtReader\Reader as TxtReader;
use StudioVisual\App\Dialects\Booglan\Booglan;

$TxtReader = new TxtReader( $filepath );

$words = trim( $TxtReader->getData() );
$words = explode(' ', $words );

$Booglan = new Booglan();

$prepositions = $Booglan->extractPrepositions( $words );
$prepositions_count = count( $prepositions );

$verbs = $Booglan->extractVerbs( $words );
$verbs_count = count( $verbs );

$fpVerbs = $Booglan->extractFirstPersonVerbs( $verbs );
$fpVerbs_count = count( $fpVerbs );

$wordsValues = $Booglan->extractValuesFromWordList( $words );
$beautifullValues = $Booglan->extractBeautifulNumbers( $wordsValues );

$uniqueBefautifulNumbers = array_unique( $beautifullValues );
$uniqueBefautifulNumbers_count = count( $uniqueBefautifulNumbers );

$sortedList = $Booglan->doSort( $words );
$sortedList = array_unique( $sortedList );

$sortedStrl = implode( ' ', $sortedList );
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Vinicius Silva">
    <title>Studio Visual</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style type="text/css">
        body {
            padding-top: 70px;
        }

        .answer-block {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://studiovisual.com.br/">Studio Visual</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#prepositions">Preposições</span></a></li>
                <li class=""><a href="#verbs">Verbos</span></a></li>
                <li class=""><a href="#fpverbs">Verbos em 1ª pessoa</span></a></li>
                <li class=""><a href="#vocabulary">Vocabulário</span></a></li>
                <li class=""><a href="#numbers">Números</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    <div class="row">
        <a name="prepositions"></a>
        <div class="col-sm-6 col-sm-offset-3 answer-block" id="prepositions">
            <p>E no Texto B, quantas preposições existem?</p>
            <div class="alert alert-info">
                <p class="answer">
                    <b>Resposta:</b> Existem
                    <span class="h4"><span class="label label-success"><?php print $prepositions_count; ?></span></span>
                    preposições no Texto B.</p>
            </div>
        </div>

        <a name="verbs"></a>
        <div class="col-sm-6 col-sm-offset-3 answer-block" id="verbs">
            <p>Já no Texto B, quantos são os verbos?</p>
            <div class="alert alert-info">
                <p class="answer"><b>Resposta:</b> Há
                    <span class="h4"><span class="label label-success"><?php print $verbs_count; ?></span></span>
                    verbos no Texto B.</p>
            </div>
        </div>

        <a name="fpverbs"></a>
        <div class="col-sm-6 col-sm-offset-3 answer-block" id="fpverbs">
            <p>E quantos verbos do Texto B estão em primeira pessoa?</p>
            <div class="alert alert-info">
                <p class="answer"><b>Resposta:</b> Há
                    <span class="h4"><span class="label label-success"><?php print $fpVerbs_count; ?></span></span>
                    verbos em primeira pessoa no Texto B.</p>
            </div>
        </div>

        <a name="vocabulary"></a>
        <div class="col-sm-6 col-sm-offset-3 answer-block" id="vocabulary">
            <p>Como seria a lista de vocabulário do Texto B?</p>
            <div class="col-sm-12 alert alert-info">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Lista de vocabulário do Texto B</h3>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control" name="vocab_b" rows="10" required="" disabled><?php print $sortedStrl; ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <a name="numbers"></a>
        <div class="col-sm-6 col-sm-offset-3 answer-block" id="numbers">
            <p>E no Texto B, quantos números bonitos <em>distintos</em> existem?</p>
            <div class="alert alert-info">
                <p class="answer"><b>Resposta:</b> No Texto B, há
                    <span class="h4"><span class="label label-success"><?php print $uniqueBefautifulNumbers_count; ?></span></span>
                    números bonitos <em>distintos</em> (atenção!).</p>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>

<script>
    ( function ( $ ) {
        $( '.navbar-collapse' ).find( 'a' ).on( 'click' , function (e) {
            e.preventDefault();
            var $this = $( this ),
                target = $this.attr( 'href' ),
                $li = $this.parent(),
                $lis = $( '.navbar-collapse' ).find( 'li' );

            $lis.removeClass( 'active' );
            $li.addClass('active');

            $('html, body').animate({scrollTop: $(target).offset().top + 70}, 200);
        });
    } ( jQuery ) );
</script>

</body>
</html>