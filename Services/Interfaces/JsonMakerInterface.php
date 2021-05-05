<?php

declare(strict_types=1);

namespace Services\Interfaces;

use Http\Response;

/**
 * Interface JsonMakerInterface
 * Контракт для формирования json-ответа
 * @package Services\Interfaces
 */
interface JsonMakerInterface
{
    /**
     * @param Response $response
     * @return string
     */
    public function makeJson(Response $response): string;
}