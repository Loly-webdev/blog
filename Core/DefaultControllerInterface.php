<?php

interface DefaultControllerInterface
{
    public function indexAction();
    public function renderView($partial, array $params);
}
