<?php

include_once(__DIR__ . '/functions.php');
include_once(__DIR__ . '/class/App.php');

$conf = include_once(__DIR__ . '/conf.php');

try {
    $app = new App( $conf );
    $app->start();
} catch(Exception $e) {
    echo "<h2>Error interno<h2>";
    echo "<h3>{$e->getMessage()}<h3>";
}



