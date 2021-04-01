<?php

namespace Models;

use Entities\Game;
use Services\NHL;

/**
 * Class GamesModel
 * @package Models
 */
class GamesModel
{
    /**
     * Returns all games
     */
    public function all()
    {
        return $this->loadFromApi();
    }

    /**
     * Loads games from the NHL API
     *
     * @return Game[]
     */
    private function loadFromApi()
    {
        $games = [];

        $api      = new NHL();
        $apiGames = $api->getAllGames();

        foreach ($apiGames as $apiGame) {
            $games[] = Game::createFromApi($apiGame);
        }

        return $games;
    }
}