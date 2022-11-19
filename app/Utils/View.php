<?php

namespace App\Utils;


// Ferramenta utilizada para pegar o conteúdo de um arquivo HTML.

class View
{

    /**
     * Váriaveis padrões da View
     * @var array
    */
    private static $vars = [];

    /**
     * Método responsável por definir os dados inicias da classe
     * @param array $vars
    */
    public static function init ($vars = []){
        self::$vars = $vars;
    }

    /**
     * Método responsável por retornar o conteúdo de uma view
     * @param string $view
     * @return string
    */
    private static function getContentView($view){
        $file = __DIR__ . '/../../resources/view/' .$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }


    /**
     * Método responsável por retornar o conteúdo renderizado
     * @param string $view
     * @param array @vars (string/numeric)
     * @return string
    */

    // Podemos informar o nome da View e as variaveis que devem ser observadas.
    public static function render($view, $vars = []){
        //CONTEÚDO DA VIEW
        $contentView = self::getContentView($view);

        //MERGE DE VARIÁVEIS DA VIEW
        $vars = array_merge(self::$vars,$vars);



        //CHAVES DO ARRAAY DE VARIÁVEIS
        $keys = array_keys($vars);
        $keys = array_map(function ($item){
            return '{{'. $item .'}}';
        },$keys);



        //RETORNA O COTEÚDO RENDERIZADO
        return str_replace($keys,array_values($vars), $contentView);

    }

}