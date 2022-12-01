<?php

namespace App\Model\Entity;

use WilliamCosta\DatabaseManager\Database;

/**
 *
 */
class User
{
    /**
     * @var integer
     */
    public $id;


    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $nome;

    /**
     * @var string
     */
    public $senha;


    /**
     * @param $email
     * @return User
     */
    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

}