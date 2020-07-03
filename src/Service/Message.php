<?php


namespace App\Service;


class Message
{
    static public function getMessage($value, string $success, string $error)
    {
        $isValid = ('' !== $value && true === $value);

        return [
          'status' => $isValid ? 'success' : 'danger',
          'statusMessage' => $isValid ? $success : $error
        ];
    }

}