<?php
/**
 * Configuración
 */
return [
    'url' => 'localhost/zankyou', // url de la aplicacion
    'pluginsPath' => __DIR__ . '/plugins', // directorio de los plugins

    // configuración de los plugins
    'plugins' => [
        'SizeEditor' => [
            'resize' => 2, // pixeles
            'scale' => true
        ],
        'CoolBlur' => [
            'blur_size' => 4, // pixeles
        ]
    ]
];