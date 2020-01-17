<?php

interface DefaultControllerInterface
{
    public function indexAction();
    public function renderView(string $view, array $params, string $viewFolder = null ) : void;
    public function getFolderView() : string;
}
