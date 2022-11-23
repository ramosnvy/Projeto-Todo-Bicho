<?php

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use Closure;

class Queue
{

    /**
     * Mapeamento de middlewares
     * @var array
    */
    private static  $map = [];



    /**
     * Fila de middlewares a serem executados
     * @var array
    */
    private array $middlewares = [];

    /**
     * Função de executar do controlador
     * @var Closure
    */
    private Closure $controller;

    /**
     * Argumentos da função controlador
     * @var array
    */
    private array $controllerArgs = [];


    /**
     * Método responsável por construir a classe de fila de middlewares
     * @param array $middlewares
     * @param Closure $controller
     * @param array $controllerArgs
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {
        $this->middlewares = $middlewares;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /**
     * Método responsável por definir o mapeamento de middlewares
     * @param array $map
     */
    public static function setMap(array $map): void
    {
        self::$map = $map;
    }

    /**
     * Método responsável por executar o próximo nível da fila de middlewares
     * @param  Request $request
     * @return Response
     */
    public function next ($request){
        //VERIFICA SE A FILA ESTA VAZIA

        if(empty($this->middlewares)) return call_user_func_array($this->controller, $this->controllerArgs);

        //MIDDLEWARE
        $middleware = array_shift($this->middlewares);

        //VERIFICA O MAPEAMENTO
        if(!isset(self::$map[$middleware])){
            throw new \Exception("Problemas ao processar o middleware da requisição", 500);
        }
    }

}