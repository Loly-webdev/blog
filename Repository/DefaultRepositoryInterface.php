<?php

interface DefaultRepositoryInterface
{
    public static function getTablePk();
    public static function getTableName();
    public static function getOrderBy();
}