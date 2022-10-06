<?php
namespace Domains\Actions;
use Support\NewsData;

class NewDataSource
{
    public function __invoke()
    { dd(config('newsconfig.enable_news_data'));
        if (config('newsconfig.enable_news_data')) {
            $response = NewsData::getNewsTopHeadlines();
            dd($response);
            return NewsData::collection($response)->collection;
        }
    }

}