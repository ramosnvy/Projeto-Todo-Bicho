<?php

namespace App\Model\Entity;

use PDOStatement;
use WilliamCosta\DatabaseManager\Database;


class Animal
{

    /**
     * ID do animal
     * @var int
     */
    public $id;

    /**
     * Nome do animal
     * @var string
     */
    public $nome;

    /**
     * Descrição
     * @var string
     */
    public $descricao;

    /**
     * Imagem do animal
     */
    public $imagem;


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
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * @return string
     */
    public function getDescricaoMax(): string
    {
        $descricao = $this->descricao;

        $descricao = "$descricao";

        return $descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    /**
     * @return mixed
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * @param mixed $imagem
     */
    public function setImagem($imagem): void
    {
        $this->imagem = $imagem;
    }

    //

    public function cadastrar()
    {
        $this->id =(new Database('animais')) ->insert(
            [
                'nome' =>$this->nome,
                'descricao'=>$this->descricao,
                'imagem'=>$this->imagem
            ]);

    }

    public function remove()
    {
        $wehre =" 'animais'.'id' = $this->id; ";

        echo $wehre;

       $this->id= (new Database('animais')) ->delete("$");
    }


    /**
     * Método responsável por retornar os animais
     */
    public static function getAnimais($where = null, $order = null, $limit = null, $fields ='*')
    {

        return (new Database('animais'))->select($where,$order,$limit,$fields);
        
    }





}