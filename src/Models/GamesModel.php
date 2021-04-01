<?php

namespace Models;

use Entities\Game;
use Services\NHL;

/**
 * Class GamesModel
 * @package Models
 */
class GamesModel extends BaseModel
{
    /**
     * Returns all games
     * @param string $date
     * @return Game[]
     */
    public function allForDate($date)
    {
        $games = $this->getGamesForDate($date);

        if (empty($games)) {
            $games = $this->loadFromApi($date);
            $this->saveGames($games);
        }
        return $this->loadFromApi($date);
    }

    /**
     * @param $date
     * @return Game[]
     */
    private function getGamesForDate($date)
    {
        $params = [
            $date . ' 00:00:00',
            $date . ' 23:59:59',
        ];

        $sql = "SELECT
                    away,
                    home,
                    start,
                    venue
                WHERE
                    start BETWEEN ? AND ?;
            
        ";

        $results = $this->executePreparedQuery($sql, $params);

        $games = [];

        foreach ($results as $result) {
            $games[] = Game::createFromDb($result);
        }

        return $games;
    }

    /**
     * Loads games from the NHL API
     *
     * @param string|null $date
     * @return Game[]
     */
    private function loadFromApi($date = null)
    {
        $games = [];

        $api = new NHL();
        $apiGames = $api->getAllGames($date);

        foreach ($apiGames as $apiGame) {
            $games[] = Game::createFromApi($apiGame);
        }

        return $games;
    }

    /**
     * This method saves games received from the API
     * @param Game[] $games
     * @return bool If the save was successful
     */
    private function saveGames(array $games)
    {
        $returnValue = true;
        if (!empty($games)) {
            $params = [];

            $rows = [];
            $row = '(?, ?, ?, ?)';

            // Process each game
            foreach ($games as $game) {
                // Add to the prepared statement
                $params[] = $game->away;
                $params[] = $game->home;
                $params[] = $game->start->format('Y-m-d H:i:s');
                $params[] = $game->venue;

                // Add placeholders
                $rows[] = $row;
            }

            // Implode rows into a valid list of values
            $values = implode(', ', $rows);

            $sql = "INSERT INTO games 
                    (away, home, start, venue)
                VALUES
                    {$values};
            ";

            $returnValue = $this->executePreparedQuery($sql, $params);
        }

        return $returnValue;
    }
}