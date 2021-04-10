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


    private array $contentAction;
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

    public function __construct(array $headers ,int $statusCode,array $contentAction ,?string $content="")
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->contentAction = $contentAction;
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

    /**
     * Разрешение ответа. Заголовки + контент
     * @return void
     */
    public function resolve(): void
    {
        $this->sendHeaders();
        $this->resolveAction();
        $this->sendContent();
    }

    /**
     * Разрешить метод контроллера в контент
     * @return void
     */
    private function resolveAction(): void
    {
        $this->content = $this->contentAction['controller']->{$this->contentAction['action']}();
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
    private function sendContent(): void
    {
        echo $this->content;
    }

}