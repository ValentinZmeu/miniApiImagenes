<?php

/**
 * Clase app que maneja todo el cotarro
 */
class App {
    private $conf = [];
    private $plugins;
    private $router;
    private $imagePath;

    public function __construct( $conf ) {
        $this->conf = (object) $conf;
        $this->plugins = (object) [];

        $this->checkRequiredConf(); 
        $this->saveImage();
        $this->loadPlugins();
        $this->initRouter();
    }

    /**
     * Función que inicia la mágia
     */
    public function start() {
        $this->callPlugins($this->router->plugins, $this->router->params);
        // $this->callPlugin($this->router->plugin, $this->router->action);
        die();
    }

    /**
     * Funcion que guarda la imagen y guarda el $imagePath
     */
    public function saveImage() {
        $this->imagePath = ''; // donde se guarda la imagen
    }

    /** 
     * Función que comprueba si en el config están todos los parametros necesarios para el funcionamiento de
     * la aplicación. Salta una excepción en caso de no existir el parametro necesario.
     */
    private function checkRequiredConf() {
        $requiredParams = ['pluginsPath'];
        foreach($requiredParams as $param) {
            if( !isset($this->conf->$param) ) {
                throw new Exception("Esto va mal... FALTA EL PARAMETRO $param");
            }
        }
    }

    /**
     * Carga de los plugins definidos en la configuración
     */
    private function loadPlugins() {
        // si hay path de plugins y array de los mismo
        if(isset($this->conf->pluginsPath) && isset($this->conf->plugins)) {
            include_once $this->conf->pluginsPath.'/Plugin.php';
            // por cada plugin en la conf
            foreach($this->conf->plugins as $name => $plugConf) {
                $pluginFile = $this->conf->pluginsPath.'/'.$name.'.php'; // donde se supone que debe estar
                // se comprueba y carga el plugin si existe su fichero
                if( $this->conf->pluginsPath && file_exists($pluginFile)) {
                    include_once $pluginFile;
                    $this->plugins->$name = new $name($plugConf);
                    $this->plugins->$name->setImagePath( $this->imagePath );
                    
                } else {
                    throw new Exception("El plugin $name no existe.");
                }
            }
        }
    }

    /**
     * Instancia el enrutador
     */
    private function initRouter() {
        include_once __DIR__ . '/Router.php';
        $this->router = new Router($this->conf );
    }

    /**
     * Llama la función start de los distintos plugins
     */
    public function callPlugins($plugins, $params = []) {
        foreach ($plugins as $plugin) {
            // si existe el plugin solicitado
            if( isset($this->plugins->$plugin) ) {
                $action = 'start';

                // si el plugin tiene ese action
                if( method_exists($this->plugins->$plugin, $action) ) {
                    $this->plugins->$plugin->$action( $params );
                } else {
                    echo 'no existe el action solicitado';
                }
            }
        }
    }

}