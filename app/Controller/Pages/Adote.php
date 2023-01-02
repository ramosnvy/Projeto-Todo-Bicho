<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Animal;

class Adote extends Page {




    /**
     * Método responsável por obter o conteúdo de animais
     * @return string
     */
    private static function getAnimaisItens(){

        $card = '';

        //Resultado da página
        $results = Animal::getAnimais(null);


        //Renderiza
        while($obAnimal = $results->fetchObject(Animal::class)){
            $card .= View::render('pages/cadastrar/card', [ 'name'=>$obAnimal->nome, 'description'=>$obAnimal->descricao ,'imagem'=>$obAnimal->imagem]);
        }

        return $card;

    }



    /**
     * Método responsável por retornar o conteúdo (view)
     * @return string
     */
    public static function getAdote(){

        $content = View::render('pages/adote', [
            'cards'=>self::getAnimaisItens() ])  ;



        return parent::getPage('Adote', $content);
    }





}