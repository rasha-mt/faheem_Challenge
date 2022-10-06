<?php

namespace Support;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\ConnectionException;

class NewsDataManager
{
    const BASE_URL = 'https://newsdata.io/api/1/news';

    public static function getNewsTopHeadlines()
    {

        try {
            $response = Http::get(self::BASE_URL . "?apikey=pub_11986300b17e0485b491b225db76b18eefd03&q=pegasus&language=en");

            $result = json_decode($response?->getBody())?->results;

            Cache::put("news.top-headlines", $result, now()->addHours(2));

            return $result;
        } catch (Exception $exception) {

            return Cache::get("news.top-headlines", []);
        }
    }


}