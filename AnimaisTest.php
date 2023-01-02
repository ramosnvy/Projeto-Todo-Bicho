<?php

use PHPUnit\Framework\TestCase;

class AnimaisTest extends TestCase
{

    public function testCadastroNome()
    {
        $animal = new \App\Model\Entity\Animal();

        $animal->setNome('Cachorro01');
        $nome = $animal->getNome();



        $this->assertTrue($animal->getNome() === $nome);

    }

    public function testCadastroDescricao()
    {
        $animal = new \App\Model\Entity\Animal();


        $animal->setDescricao('Cachorro bravo');
        $descicao = $animal->getDescricao();


        $this->assertTrue($animal->getDescricao() === $descicao);

    }

    public function testCadastroImagem()
    {
        $animal = new \App\Model\Entity\Animal();

        $this->assertTrue(isset($animal->imagem));
    }

    
}