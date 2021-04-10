<?php
declare(strict_types=1);

namespace Services;

class SessionService extends \SessionHandler
{


    public function __construct()
    {
    }

    public function start(): SessionService
    {
        session_start();
        return $this;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set(string $key, $value): SessionService
    {
        self::setValue($key, $value);
        return $this;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return self::getValue($key);
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function setValue(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @return void
     */
    public static function destroySession(): void
    {
        session_destroy();
        session_abort();
        unset($_SESSION);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public static function getValue(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @return int
     */
    public function status(): int
    {
        return session_status();
    }
}