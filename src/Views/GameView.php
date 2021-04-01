<?php

namespace Views;

use Entities\Game;

/**<
 * Class HomeView
 * @package Views
 */
class GameView extends BaseView
{
    /** @var Game[] */
    private $games;

    /**
     * Renders the current view
     */
    public function render()
    {
        echo 'I\'m the view';
    }
}