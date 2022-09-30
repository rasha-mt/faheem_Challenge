<?php

namespace App\Http\Controllers;

use Support\NewsApi;
use Illuminate\Http\Request;
use App\Http\Resources\News;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if (Cache::has('news.top-headlines')) {
            /**
             * Cache for increase Performance , save articles result for two hours
             */
            $response = Cache::get("news.top-headlines");

            return News::collection($response);
        }

        $response = NewsApi::getNewsTopHeadlines();

        /** @var NewsApi Facade $response */
        return News::collection($response)->collection;

    }

    public function search(Request $request)
    {
        $keyword = $request->input('query');

        /** @var NewsApi Facade $response */
        $response = NewsApi::searchForNews($keyword);

        return News::collection($response)->collection;
    }
}
