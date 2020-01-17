<?php

require_once PROJECT_CORE . 'DefaultPDO.php';

abstract class DefaultManager extends DefaultPDO
{
    /**
     * The construct method make the connection to the database and load the Request class
     * @throws Exception
     */
    public static function getPDO()
    {
        return DefaultPDO::PDOConnect();
    }
}
