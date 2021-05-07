<?php
declare(strict_types=1);


namespace App\Controllers;

/**
 * Общий интерфейс для всех контроллеров
 * Interface ControllerInterface
 * @package App\Controllers
 */
interface ControllerInterface
{
    /**
     * Возвращает массив с промежуточными обработчиками запроса
     * @return array
     */
    public function middleware(): array ;

    /**
     * Дефолтный метод контроллера
     * @return mixed
     */
    public function default() ;
}