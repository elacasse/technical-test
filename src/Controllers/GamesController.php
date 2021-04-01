<?php

namespace Controllers;

use Models\GamesModel;
use Views\GameView;

/**
 * Class Home
 *
 * The controller for the homepage
 *
 * @package Controllers
 */
class GamesController extends BaseController
{
    /**
     * Controller for the
     */
    protected function indexGet()
    {
        $this->view = new GameView();

        $gamesModel = new GamesModel();

        $this->view->games = $gamesModel->all();

        return $this->displayResults();
    }


}