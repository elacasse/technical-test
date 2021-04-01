<?php


namespace Services;

/**
 * Class NHL
 *
 * Wrapper for calls to the NHL API
 *
 * @package Services
 */
class NHL
{
    const BASE_URL = 'http://statsapi.web.nhl.com/api';
    const VERSION = 'v1';

    /**
     * Execute a GET call to the API
     * @param string $url
     */
    private function get($url)
    {
        $url = self::BASE_URL . '/' . self::VERSION . '/' . $url;

        // Create & initialize a curl session
        $curl = curl_init();

        // Set our url with curl_setopt()
        curl_setopt($curl, CURLOPT_URL, $url);

        // Return the transfer as a string, also with setopt()
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        // curl_exec() executes the started curl session
        // $output contains the output string
        $output = curl_exec($curl);

        // close curl resource to free up system resources
        // (deletes the variable made by curl_init)
        curl_close($curl);

        return $output;
    }

    /**
     * Get all available games for today
     * @param string|null $date
     * @return mixed
     */
    public function getAllGames($date = null)
    {
        $url = 'schedule';

        if ($date != null) {
            $url .= '?date=' . $date;
        }

        $schedule = json_decode($this->get($url));
        return $schedule->dates[0]->games;
    }
}