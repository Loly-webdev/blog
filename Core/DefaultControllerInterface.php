<?php

interface DefaultControllerInterface
{
    // Action method
    public function indexAction();

    // View Method
    public function renderView(string $viewName, array $params, string $viewFolder = null): void;

    // Path of view files
    public function getFolderView(): string;

    // To instance Request object
    public function getRequest();
}
