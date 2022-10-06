<?php
namespace Domains\Actions;
use Support\NewsApi;
use App\Http\Resources\News;

class NewsIoSource
{

    public function __invoke()
    {
        if (config('newsconfig.enable_news_io')) {
            $response = NewsApi::getNewsTopHeadlines();
            return News::collection($response)->collection;
        }

    }

}