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
    public $games;

    /**
     * Renders the current view
     */
    public function render()
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'Templates' . DIRECTORY_SEPARATOR  . 'game.php';
        print $this->loadTemplate($file, ['games' => $this->games]);
    }
}