<?php

namespace App\Session\Admin;

use App\Model\Entity\User;

class Login
{

    /**
     * Método responsável por iniciar a sessão
     */
    private static function init(){
        //VERIFICA SE A SESSÃO NÃO ESTA ATIVA

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }

    }

    /**
     * @param User $obUser
     * @return boolean
     */
    public static function login($obUser){
        //Inicia a sessão
        self::init();

        //define a sessão do usuario
        $_SESSION['admin']['usuario'] = [
                'id'=>$obUser->id,
            'nome'=>$obUser->nome,
            'email'=>$obUser->email
        ];

        return true;
    }

    /**
     * Método responsável por verificar se o usuário está logado
     * @return boolean
     */
    public static function isLogged()
    {
        //Inicia a sessão
        self::init();

        //Retorna a verificação
        return isset($_SESSION['admin']['usuario']['id']);
    }

    /**
     * Método responsável por executar o logout do usuário
     * @return bool
     */
    public static function logout ()
    {
        //Inicia a sessão
        self::init();

        //Desloga o usuario
        unset($_SESSION['admin']['usuario']);

        //Sucesso
        return true;
    }

}