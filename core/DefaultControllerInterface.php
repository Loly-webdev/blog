<?php

namespace Core;

/**
 * Interface DefaultControllerInterface
 * @package Core
 */
interface DefaultControllerInterface
{
    /**
     * Action method
     * @return mixed
     */
    public function indexAction();

    /**
     * Template Method
     *
     * @param string      $viewName
     * @param array       $params
     * @param string|null $viewFolder
     */
    public function renderView(string $viewName, array $params, string $viewFolder = null): void;

    /**
     * Path of view files
     * @return string
     */
    public function getFolderView(): string;

    /**
     * To instantiate the request object
     * @return mixed
     */
    public function getRequest();
}
