<?php

/**
 * 
 *  Funciones globales para uso en la plataforma
 * 
 */

function dd( $param ) {
    var_dump( $param );
    die();
}

function d( $param ) {
    print_r( $param );
    die();
}

function basePath( $path ) {
    $path = trim($path,'/');
    return __DIR__ . '/' . $path;
}