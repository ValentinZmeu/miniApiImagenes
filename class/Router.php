<?php

class Router {
    private $url;
    private $referer;
    private $requestUrl;

    public $plugin = null;
    public $action = null;
    
    public $plugins = [];
    public $params = [];
    
    public function __construct( $config ) {
        $this->url = $config->url;
        $this->requestUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $this->analizeRequest();
    }

    /**
     * Trocea la url y saca el plugin y el action del mismo (si existe)
     */
    private function analizeRequest() {
        $request = str_replace(['https://', 'http://'], '', $this->requestUrl);
        $request = str_replace($this->url, '', $request);
        $request = trim($request, '/');
        $request = explode('/', $request);

        // esto era con la idea de hacer una api que se llame con /NombrePlugin/funcionPlugin
        $this->plugin = isset($request[0]) && $request[0] ? $request[0] : null;
        $this->action = isset($request[1]) && $request[1] ? $request[1] : null;

        // se asignan TODOS los plugins que se quieren llamar
        foreach ($request as $pluginName) {
            $pluginName = explode('?', $pluginName)[0];
            $this->plugins[] = $pluginName;
        }

        foreach($_REQUEST as $name => $val) {
            $this->params[$name] = $val;
        }
        
    }

}