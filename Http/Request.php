<?php

declare(strict_types=1);

namespace Http;


class Request
{
    /**
     * Массив get-запроса
     *@var ?array
     */
    private ?array $get;

    /**
     * Массив post-запроса
     * @var ?array
     */
    private ?array $post;

    /**
     * Строка запроса
     * @var string
     */
    private string $uri;

    /**
     * Метод запроса
     * @var string
     */
    private string $method;

    /**
     * Заголовки запроса
     * @var ?array
     */
    private ?array $requestHeaders;

    public function __construct()
    {
        $this->get = filter_var_array($_GET, INPUT_GET) == false ? null : $_GET;
        $this->post = filter_var_array($_POST, INPUT_POST) == false ? null : $_POST;
        $this->requestHeaders = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
    }

    /**
     * Получить заголовки запроса
     * @return array
     */
    private function headers(): ?array
    {
        /*if(empty($_SERVER)){
            return null;
        }
        $headers = [];
        foreach($_SERVER as $key=>$value){
            $match = substr($key,0,5);
            if( $match === 'HTTP_'){
                $headers[str_replace($match)] = $value;
            }
        }
        return $headers;*/
        var_dump($_SERVER);
        return getallheaders();
    }

    /**
     * Проверка ajax-запроса
     * @return bool
     */
    public function isAjax(): bool
    {
        return !empty($this->headers()['HTTP_X_REQUESTED_WITH']);
    }

}