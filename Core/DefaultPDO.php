<?php

require_once PROJECT_CORE . 'AbstractPDO.php';

class DefaultPDO extends AbstractPDO
{
    public function getHostKey(): string
    {
        return 'default';
    }
}