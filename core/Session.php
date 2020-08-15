<?php

namespace Core;

/**
 * Class Session
 * @package Core
 */
final class Session
{
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

    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}

