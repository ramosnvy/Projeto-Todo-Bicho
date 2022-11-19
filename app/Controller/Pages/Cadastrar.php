<?php

namespace App\Controller\Pages;

use App\Http\Request;
use \App\Utils\View;
use App\Model\Entity\Animal;


class Cadastrar extends Page {

    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     * @return string
     */
    public static function getCadastrar(){


        $content = View::render('pages/cadastrar', []);

        return self::getPrivatePage('Cadastrar', $content);
    }

    /**
     * @param Request $request
     * @return string
    */
    public static function insertAnimais($request)
    {
        $postVars = $request->getPostVars();

        //Novo instancia de Animais
        $obAnimail = new Animal();
        $obAnimail->nome = $postVars['nome'];
        $obAnimail->descricao = $postVars['descricao'];
        $obAnimail->imagem = $postVars['imagem'];

        $obAnimail->cadastrar();



        return self::getCadastrar();
    }


}