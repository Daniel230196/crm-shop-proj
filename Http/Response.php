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

    public function __construct(string $statusText,$statusCode = 200, ?string $content="")
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
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

    }

}