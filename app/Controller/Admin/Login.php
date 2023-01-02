<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Model\Entity\User;
use \App\Utils\View;
use App\Session\Admin\Login as SessionAdminLogin;

/**
 *
 */
class Login extends Page {

    /**
     * Método responsável por retornar o conteúdo (view)
     * @return string
     */
    public static function getLogin($request, $errorMenssage = null){

        //Status
        $status = !is_null($errorMenssage) ? Alert::getError($errorMenssage) : '';

        //Conteudo da pagina de login
        $content = View::render('admin/login', [
            'status'=>$status
        ]);
        //Retorna a pagina completa
        return parent::getPage('Login', $content);
    }

    /**
     * Método responsável por definir o login do usuário
     * @param $request
     *
     */
    public static function setLogin($request){

        //POST VARS
        $postVars = $request->getPostVars();

        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        //BUSCA O USUÁRIO PELO E-MAIL
        $obUser = User::getUserByEmail($email);
        if(!$obUser instanceof User) return self::getLogin($request, 'E-mail ou senha inválidos');

        //VERIFICA A SENHA DO USUARIO
        if(!password_verify($senha, $obUser->senha)) return self::getLogin($request,'senha inválidos');

        //Cria sessão de login
        SessionAdminLogin::login($obUser);

        //Redireciona o usuário para home painel
        $request->getRouter()->redirect('/painel');

    }


    /**
     * @param $request
     *
     */
    public static function setLogout($request)
    {
        //Destroi sessão de login
        SessionAdminLogin::logout();

        //Redireciona o usuário para home painel
        $request->getRouter()->redirect('/login');
    }


}