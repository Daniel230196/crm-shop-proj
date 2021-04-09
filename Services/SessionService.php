<?php
declare(strict_types=1);

namespace Services;

class SessionService
{

    public function __construct()
    {

    }

    public static function init(): void
    {
        session_start();
    }

    public static function set(string $key, string $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function destroy(): bool
    {
        return session_destroy();
    }

    public static function get($key): ?string
    {
        return $_SESSION[$key] ?? null;
    }
}