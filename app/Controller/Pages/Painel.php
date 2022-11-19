<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Animal;

class Painel extends Page {



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
            $card .= View::render('pages/painel/card', ['name'=>$obAnimal->nome, 'description'=>$obAnimal->descricao ,'imagem'=>$obAnimal->imagem]);
        }

        return $card;

    }


    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     * @return string
     */
    public static function getPainel(){


        $content = View::render('pages/painel', ['cards'=>self::getAnimaisItens()]);

        return self::getPrivatePage('Painel', $content);
    }

    public static function removeAnimal($request)
    {
        $postVars = $request->getPostVars();

        //Novo instancia de Animais
        $obAnimail = new Animal();

        $obAnimail->remove();



        return self::getPainel();

    }

}