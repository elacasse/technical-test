<?php

namespace Entities;

use DateTimeZone;
use stdClass;

/**
 * Class Games
 * @package Entities
 */
class Game
{
    public $away;
    public $home;
    public $start;
    public $venue;

    /**
     * Game constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value)
        {
            switch (true) {
                /** @noinspection PhpMissingBreakStatementInspection */
                /** Deliberate fallthrough */
                case ($key == 'start' && is_string($value)):
                    $value = date_create_from_format('Y-m-d\TH:i:s\Z', $value, new DateTimeZone('UTC'));
                    $value->setTimezone(new DateTimeZone(date_default_timezone_get()));

                default:
                    $this->$key = $value;
                    break;
            }
        }
    }

    /**
     * Create a game Entity from API data
     * @param stdClass $gameData
     * @return Game
     */
    public static function createFromApi($gameData)
    {
        return new self([
            'away'  => $gameData->teams->away->team->name,
            'home'  => $gameData->teams->home->team->name,
            'start' => $gameData->gameDate,
            'venue' => $gameData->venue->name,
        ]);
    }
}