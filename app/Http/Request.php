<?php

namespace App\Http;

class Request
{

    /** Método HTTP da requisição
     * @var string
     */
    private $httpMethod;

    /** URI da página
     * @var string
     */
    private $uri;

    /** Parâmetros da URL ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Variáveis recebidas no POST da página ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Cabeçalho daa requisição
     * @var array
     */
    private $headers = [];

    /**
     * Instância do router
    */
    private $router;


    public function __construct($router)
    {
        $this->router = $router;
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri();

    }



    /**
     * Método responsável por definir URI
     * @return Router
     */

    private function setUri(){
        //URI COMPLETA COM GETS
        $this->uri =  $_SERVER["REQUEST_URI"] ?? '';

        //REMOVE GETS DA URI

        $xUri = explode('?',$this->uri);
        $this->uri = $xUri[0];
    }

    /**
     * Método responsável por retornar a instância do router
     * @return Router
     */

    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Método responsável por retornar o método HTTP
     * @return string
     */
    public function getHttpMethod(): string
    {
        return $this->httpMethod;
    }

    /**
     * Retorna URI da requisição
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Retorna os parametros
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * Retorna as vars do $_POST
     * @return array
     */
    public function getPostVars(): array
    {
        return $this->postVars;
    }

    /**
     * Retorna os headers da requisição
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

}