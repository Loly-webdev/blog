<?php

namespace App\Service;

/**
 * Class Message
 * @package App\Service
 */
class Message
{
    /**
     * @param mixed  $value
     * @param string $success
     * @param string $error
     *
     * @return array|string[]
     */
    public static function getMessage(
        $value,
        string $success,
        string $error
    ): array
    {
        $isValid = true === $value;

        return [
            'status'        => $isValid ? 'success' : 'danger',
            'statusMessage' => $isValid ? $success : $error
        ];
    }
}
