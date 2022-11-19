<?php

namespace App\Http;

class Response
{

    /**
     * Código do status HTTO
     * @var int
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do Response
     * @var array
     */
    private $headers = [];

    /**
     * Tipo do conteúdo
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Conteúdo do Response
     * @var mixed
     */
    private $content;

    /**
     *
     * @param int $httpCode
     * @param array $headers
     * @param string $contentType
     * @param mixed $content
     */



    public function __construct(int $httpCode,mixed $content, string $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
        
    }

    /**
     * Método responsável por alterar o content type do response
     * @param $contentType
     * @return void
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type',$contentType);
    }

    /**
     * Método responsável por adicionar um registro no cabeçalho de response
     * @param $key
     * @param $value
     * @return void
     */
    public function addHeader($key, $value)
    {
     $this->headers[$key] = $value;
    }

    public function sendHeaders()
    {
        //STATUS
        http_response_code($this->httpCode);

        //ENVIAR HEADERS
        foreach ($this->headers as $key=>$value){
            header($key.': ' . $value);
        }
    }

    /**
     * Método responsável por enviar a resposta paara o usuário
     *
     */
    public function sendResponse()
    {
        switch ($this->contentType){
            case 'text/html':
                echo $this->content;
                exit;
        }

    }
    

}