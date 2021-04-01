<?php

namespace Controllers;

use Views\BaseView;

/**
 * Class BaseController
 *
 * Shared base methods for controllers
 *
 * @package Controllers
 */
abstract class BaseController
{
    /** @var BaseView  */
    protected $view;

    /**
     * @return mixed
     */
    abstract protected function indexGet();

    /**
     * Invoker for the autoloader. Might be move to a dedicated file later.
     */
    public function __invoke()
    {
        $this->indexGet();
    }

    /**
     * Call the views and displays the results
     */
    protected function displayResults()
    {
        $this->view->render();
    }
}