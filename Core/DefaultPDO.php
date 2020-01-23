<?php

require_once PROJECT_CORE . 'AbstractPDO.php';

class DefaultPDO extends AbstractPDO
{
    public static function getHostKey(): string
    {
        return 'default';
    }
}