<?php

namespace App\Model\Entity;

use PDOStatement;
use WilliamCosta\DatabaseManager\Database;


class Image
{

    /**
     * ID da imagem
     * @var int
     */
    public $id;

    /**
     * ID do animal
     * @var string
     */
    public $animal_id;

    /**
     * Path
     * @var string
     */
    public $path;



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getAnimalId(): int
    {
        return $this->animal_id;
    }


    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


    public function cadastrarImagem()
    {
        $this->id =(new Database('imagens')) ->insert(
            [
                'nome' =>$this->nome,
                'descricao'=>$this->descricao,
                'imagem'=>$this->imagem
            ]);

    }


    /**
     * Método responsável por retornar os animais
     */
    public static function getAnimais($where = null, $order = null, $limit = null, $fields ='*')
    {

        return (new Database('animais'))->select($where,$order,$limit,$fields);

    }





}