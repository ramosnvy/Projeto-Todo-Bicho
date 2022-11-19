<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page{

    /**
     * Método responsável por renderizar o header
     * @return string
     */
    public static function getHeader(){
        return View::render('pages/header');
    }

    /**
     * Método responsável por renderizar o header privado
     * @return string
     */
    public static function getPrivateHeader(){
        return View::render('pages/privateHeader');
    }

    /**
     * Método responsável por renderizar o footer
     * @return string
     */
    public static function getFooter(){
        return View::render('pages/footer');
    }

    /**
     * Método responsável por renderizar o footer privado
     * @return string
     */
    public static function getPrivateFooter(){
        return View::render('pages/privateFooter');
    }



    /**
     * Método responsável por retornar o conteúdo da mpssa página genérica
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('pages/page', ['Title'=>$title, 'content'=>$content, 'Nav'=>self::getHeader(), 'footer'=>self::getFooter()]);
    }

    /**
     * Método responsável por retornar o conteúdo da mpssa página genérica privada
     * @return string
     */
    public static function getPrivatePage($title, $content){
        return View::render('pages/page', ['Title'=>$title, 'content'=>$content, 'Nav'=>self::getPrivateHeader(), 'footer'=>self::getPrivateFooter()]);
    }



}