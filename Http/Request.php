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

    /**
     * IP клиента
     * @var string|null
     */
    private ?string $client;

    public function __construct()
    {
        $this->get = filter_var_array($_GET, INPUT_GET) == false ? null : $_GET;
        $this->post = filter_var_array($_POST, INPUT_POST) == false ? null : $_POST;
        $this->requestHeaders = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->client = $_SERVER['REMOTE_ADDR'] ?? null;
    }

    public function getIp(): ?string
    {
        return $this->client;
    }

    /**
     * Получить заголовки запроса
     * @return array
     */
    private function headers(): ?array
    {
        return getallheaders();
    }

    /**
     * Проверка ajax-запроса
     * @return bool
     */
    public function isAjax(): bool
    {
        return !empty($this->headers()['X-Requested-With']) ||
                strpos($this->getHeader('Accepts'), 'application/json');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return isset($this->$name) ? $this->$name : null;
    }

    /**
     * Получить метод контроллера из строки запроса
     * @return ?string
     */
    public function action(): ?string
    {

        $method = $this->explodeUri()[2] ?? null;

        if(!is_null($method)){
            return strpos($method, '?') ? stristr($method, '?', true) : $method ;
        }

        return null;
    }

    /**
     * Полчить имя контроллера
     * @return ?string
     */
    public function controller(): ?string
    {
        return $this->explodeUri()[1] ?? null;

    }

    /**
     * Разбить строку запроса
     * @return array
     */
    private function explodeUri(): array
    {
        return explode('/',$this->uri);
    }

    public function method(): ?string
    {
        $uriParts = explode('/',$this->uri);

        if(isset($uriParts[2])){
          return strpos($uriParts[2],'?') ?
                 explode('?',$uriParts[2])[0] :
                 $uriParts[2];
        }

        return null;
    }

    public function getHeader($key): string
    {
        return $this->headers()[$key];
    }
}