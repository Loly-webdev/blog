<?php

namespace Core;

interface DefaultControllerInterface
{
    // Action method
    public function indexAction();

    // Template Method
    public function renderView(string $viewName, array $params, string $viewFolder = null): void;

    // Path of view files
    public function getFolderView(): string;

    // To instantiate the request object
    public function getRequest();
}
