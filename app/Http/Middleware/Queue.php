<?php

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use mysql_xdevapi\Exception;

class Queue
{


    /**
     * Mapeamento de Middlewares
     * @var array
     */
    private static $map = [];

    /**
     * Fila de middlewares a serem executados
     * @var array
     */
    private $middlewares = [];

    /**
     * Função de execução do controlador
     * @var Closure
     */
    private $controller;

    /**
     * Argumentos da função do controlador 
     * @var array
     */
    private $controllerArgs = [];


    /**
     * Mapemamento de middlewares que serão carregados em todas as rotas
     * @var array
     */
    private static $default = [];

    /**
     * Método responsável por construir a classe de filas
     * @param array $middlewares
     * @param  Closure $controller
     * @param array $controllerArgs
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = array_merge(self::$default, $middlewares);
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
        
    }


    /**
     * Método responsável por executar o prox nível da fila de middlewares
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function next($request)
    {
        //VERIFICA SE A FILA ESTA VAZIA
        if (empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        //Middleware
        $middleware = array_shift($this->middlewares);


        //NEXT
        $queue = $this;
        $next = function ($request) use ($queue){
            return $queue->next($request);
        };

        return (new self::$map[$middleware])->handle($request, $next);

    }

    /**
     * Método responsável por definir o mapeamento de middlewares
     * @param array $map
     *
     */
    public static function setMap($map)
    {
     self::$map = $map;
    }

    /**
     * Método responsável por definir o mapeamento de middlewares padrões
     * @param array $default
     *
     */
    public static function setDefault($default)
    {
        self::$default = $default;
    }


}

