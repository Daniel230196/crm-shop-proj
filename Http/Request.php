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
        return !empty($this->headers()['HTTP_X_REQUESTED_WITH']);
    }

    public function __get($name)
    {
        return $this->$name ?? null;
    }
}