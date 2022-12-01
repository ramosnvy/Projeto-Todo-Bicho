<?php

namespace App\Http\Middleware;

use App\Http\Response;
use \App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogin
{
    /**
     * @param $request
     * @param $next
     * @return Response
     */
    public function handle($request, $next)
    {
        //Verifica se o usuario esta logado
        if(!SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/login');
        }
        //CONTINUA A EXECUÇÃO
        return $next($request);
    }


}