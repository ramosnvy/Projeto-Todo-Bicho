<?php

namespace App\Http;

use \Closure;
use \http\Exception;
use \ReflectionFunction;

class Router
{
    /**
     * URL COMPLETA DO PROJETO (RAIZ)
     * @var string
     */
    private $url = '';

    /**
     * PREFIXO DE TODAS AS ROTAS
     * @var string
     */
    private $prefix = '';

    /**
     * INDICE DE ROTAS
     * @var array
     */
    private $routes = [];

    /**
     * INSTANCIA DE REQUEST
     * @var Request
     */
    private $request;

    /**
     * MÉTODO RESPONSÁVEÇ POR INICIAR A CLASSE
     * @param string $url
     */
    public function __construct($url)
    {
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();

    }

    /**
     * Método responsável por definir o prefixo das rotas
     *
     */
    private function setPrefix ()
    {
        //INFORMAÇÕES DAA URL ATUAL
        $parseUrl = parse_url($this->url);

        //DEFINE O PREFIXO
        $this->prefix = $parseUrl['path'] ?? '';

    }


    /**
     * Método responsável por adicionar uma rota na classe
     * @param $method
     * @param $route
     * @param $params
     *
     */
    private function addRoute ($method, $route, $params = [])
    {
        //VALIDAÇÃO DOS PARÂMETROS
        foreach ($params as $key=>$value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);

            }
        }

        //VARIÁVEIS DA ROTA
        $params['variables'] = [];

        //PADRÃO DE VALIDAÇÃO DAS VARIÁVEIS DAS ROTAS
        $patternVariable = '/{(.*?)}/';
        if(preg_match_all($patternVariable, $route, $matches)){
           $route = preg_replace($patternVariable, '(.*?)', $route);
           $params['variables'] = $matches[1];
        }

        //PADRÃO DE VALIDAÇÃO DA URL
        $patternRoute = '/^' .str_replace('/','\/',$route) . '$/';
        $this>$this->routes[$patternRoute][$method] = $params;


    }


    /**
     *  método responsável por definir uma rota de GET
     * @param $route
     * @param $params
     */
    public function get($route, $params = []){
        return $this->addRoute('GET', $route, $params);

    }

    /**
     *  método responsável por definir uma rota de POST
     * @param $route
     * @param $params
     */
    public function post($route, $params = []){
        return $this->addRoute('POST', $route, $params);

    }

    /**
     *  método responsável por definir uma rota de PUT
     * @param $route
     * @param $params
     */
    public function put($route, $params = []){
        return $this->addRoute('PUT', $route, $params);

    }

    /**
     *  método responsável por definir uma rota de DELETE
     * @param $route
     * @param $params
     */
    public function DELETE($route, $params = []){
        return $this->addRoute('DELETE', $route, $params);

    }

    public function getUri()
    {
        //URI DA REQUEST
        $uri = $this->request->getUri();

        //FATIA A URI COM O PREFIXO
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        //RETORNA A URI SEM PREFIXO
        return end($xUri);
    }

    /**
     * Método responsável por retornar os dados da rota atual
     * @return array
     */
    public function getRoute()
    {
        //uri
        $uri = $this->getUri();

        //METHOD
        $httpMethod = $this->request->getHttpMethod();

        //VALIDA AS ROTAS
        foreach($this->routes as $patternRoute=>$methods){
            //VERIFICA SE A URI BATE O PADRÃO
            if(preg_match($patternRoute,$uri, $matches)){
                //VERIFICA O MÉTODO
                if(isset($methods[$httpMethod])){
                    //REMOVE A PRIMEIRA POSIÇÃO
                    unset($matches[0]);

                    //VARIÁVEIS PROCESSADAS
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys, $matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    //RETORNO DOS PARÂMETROS DA ROTA
                    return $methods[$httpMethod];
                }

                throw new \Exception("Método não é permitido", 405);
            }
        }
        throw new \Exception("URL não encontrada", 404);
    }


    /**
     * Método responsável por executar a rota atual
     * @return Response
    */
    public function run()
    {
        try {
            $route = $this->getRoute();


            if(!isset($route['controller'])){
                throw new \Exception("URL não pôde ser processada", 500);
            }

            //Arguemtos da função
            $args = [];

            //REFLECTION
            $reflection = new ReflectionFunction($route['controller']);
            foreach ($reflection->getParameters() as $parameter){
                $name =$parameter->getName();
                $args[$name] = $route['variables'][$name] ?? '';
            }

            //Retorna a execução da função
            return call_user_func_array($route['controller'], $args);


        }catch (\Exception $e){
            return new Response($e->getCode(), $e->getMessage());
        }

    }


}