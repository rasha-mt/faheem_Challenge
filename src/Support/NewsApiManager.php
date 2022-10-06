<?php

namespace Support;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\ConnectionException;

class NewsApiManager
{
    const BASE_URL = 'https://newsapi.org/v2';
    const Authorization = 'Basic 9996c563829b4cb9acfb14a347aa82c8';

    public static function getNewsTopHeadlines()
    {

        try {
            $response = Http::withToken(self::Authorization)
                ->get(self::BASE_URL . "/top-headlines?country=us&category=business");

            $result = json_decode($response?->getBody())?->articles;

            Cache::put("news.top-headlines", $result, now()->addHours(2));

            return $result;
        } catch (Exception $exception) {

            return Cache::get("news.top-headlines", []);
        }
    }

    public static function searchForNews($keyword = '')
    {
        try {
            $response = Http::withToken(self::Authorization)->get(self::BASE_URL . "/everything?q=$keyword");

            return json_decode($response?->getBody())?->articles;

        } catch (Exception $exception) {
            return [];
        }
    }
}