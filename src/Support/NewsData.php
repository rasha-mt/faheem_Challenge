<?php

namespace Support;

use Illuminate\Support\Facades\Facade;

/**
 * class NewsApiFacade
 *
 *
 * @method static getNewsTopHeadlines()
 * @method static string searchForNews($keyword)
 */
class NewsData extends Facade
{
    protected static function getFacadeAccessor()
    {
        return NewsDataManager::class;
    }

}