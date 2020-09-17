<?php

namespace Core;

use Exception;

/**
 * Class Session
 * @package Core
 */
final class Session
{
    /**
     * @return void
     */
    public static function destroy(): void
    {
        session_unset();
        session_destroy();
    }

    /**
     * @param $key
     *
     * @return string
     * @throws Exception
     */
    public static function generateToken($key): string
    {
        $value = bin2hex(random_bytes(32));
        static::setValue($key, $value);

        return $value;
    }

    /**
     * @param string $key
     * @param        $value
     *
     * @return void
     */
    public static function setValue(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    /**
     * verifie si la valeur est bonne
     * et si valid supprime le token apres
     *
     * @param $key
     * @param $value
     *
     * @return bool
     */
    public static function isValidToken($key, $value): bool
    {
        $isValidToken = static::getValue($key) === $value;

        if ($isValidToken) {
            unset($_SESSION[$key]);
        }
        return $isValidToken;
    }

    /**
     * recovers a value from the session
     * and returns the value or returns the default value.
     *
     * @param string $key
     * @param null   $defaultValue
     *
     * @return mixed|null
     */
    public static function getValue(string $key, $defaultValue = null)
    {
        $data = static::getData();

        return $data[$key] ?? $defaultValue;
    }

    /**
     * @return array
     */
    public static function getData(): array
    {
        return $_SESSION;
    }
}

