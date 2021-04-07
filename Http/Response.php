<?php

declare(strict_types=1);

namespace Http;


use Services\Interfaces\JsonMakerInterface;

class Response
{
    /**
     * Содержимое ответа
     * @var string|null
     */
    private ?string $content;

    /**
     * HTTP-статус ответа
     * @var int
     */
    private int $statusCode;

    /**
     * @var string
     */
    private string $statusText;

    /**
     * Заголовки ответа
     * @var array
     */
    private array $headers;

    public function __construct(array $headers ,$statusCode = 200, ?string $content="")
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }


    /**
     * Сформировать json-ответ определенного формата
     * @param JsonMakerInterface $jsonMaker
     * @return string
     */
    public function toJson(JsonMakerInterface $jsonMaker): string
    {
        return $jsonMaker->makeJson($this);
    }

    public function resolve()
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    /**
     * Послать заголовки ответа
     * @return void
     */
    private function sendHeaders(): void
    {
        foreach ($this->headers as $header){
            header($header);
        }
    }

    /**
     *
     */
    private function sendContent()
    {
        echo $this->content;
    }
}