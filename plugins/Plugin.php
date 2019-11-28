<?php

class Plugin {
    protected $pluginsPath = __DIR__;
    protected $imagePath = null;


    // supongamos que todos los plugins tiene unos getters y setters
    public function __construct( $options = [] ) {
        $this->setOptions($options);
    }

    // se indica la ruta de la imagen a modificar
    public function setImagePath( $imagePath ) {
        $this->imagePath = $imagePath;
    }

    /**
     * Función de "por defecto" de TODOS los plugins tienen este metodo
     */
    public function start( $params ) {
        $this->setOptions( $params );
        echo 'El plugin ' . get_called_class(). ' está ejecutando el método start() [todos los plugins lo tiene] <br>';
        echo 'Los atributos de la clase son: <br>';
        var_dump( $this );
    }

    protected function setOptions( $options ) {
        // asignamos las opciones a la clase
        foreach ($options as $name => $value) {
           
            // si la propiedad existe en la clase, se le asigna el valor, en caso contrario se ignora
            if( property_exists( get_called_class(), $name) ) {
                $this->$name = $value;
            }
        }
    }

    protected function init( $options = [] ) {
        // se inicia las cosas bonitas de la clase
        $this->setOptions( $options );
    }
}