<?php


namespace juliocapuano\SimpleAntiSpam\Clients;

class StopForumSpamClient
{

    const BASE_URI = 'http://api.stopforumspam.org/api';

    /**
     * @param array $data
     * @return bool|object
     */
    static private function getRemoteData(array $data)
    {

        try {

            $url  = self::BASE_URI;
            $data = http_build_query($data);

            $cURLConnection = curl_init();

            curl_setopt($cURLConnection, CURLOPT_URL, "{$url}?{$data}");
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

            $result = curl_exec($cURLConnection);
            curl_close($cURLConnection);
            //        $result = file_get_contents($route . $data);
            return json_decode($result);

        } catch (\Exception $exception) {
            return false;
        }

    }

    /**
     * @param $response
     * @param $action
     * @return bool|mixed
     */
    private static function processResponse($response, $action)
    {
        return isset($response->$action) ? $response->$action : false;
    }


    /**
     * @param string $action
     * @param string $data
     * @return bool|object
     */
    public static function get(string $action, string $data)
    {

        $params = [];

        $params['json']  = true;
        $params[$action] = $data;

        $response = self::getRemoteData($params);
        if (!$response)
            return false;

        return self::processResponse($response, $action);
    }
}
