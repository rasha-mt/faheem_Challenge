<?php

namespace Http\Controller;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Tests\TestCase;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewsControllerTest extends TestCase
{

    public function test_user_can_get_news()
    {
        $data = [
            "status"       => "ok",
            "totalResults" => 33,
            "articles"     => [
                (object) [
                    "source"      => (object) [
                        "id"   => null,
                        "name" => "CNBC"
                    ],
                    "author"      => "Sarah Min, Alex Harring",
                    "title"       => "S&P 500 falls as markets prepare to close out a miserable week, month and quarter - CNBC",
                    "description" => "Traders looked to close out a terrible week that brought the S&P 500 to a new 2022 low.",
                    "url"         => "https://www.cnbc.com/2022/09/29/stock-futures-are-flat-following-thursdays-broad-sell-off.html",
                ],

                [
                    "author"      => "Martin Pengelly",
                    "title"       => "Ron DeSantis changes with the wind as Hurricane Ian prompts flip-flop on aid - The Guardian US",
                    "description" => "The Florida governor ‘put politics aside’ to ask Joe Biden for federal – unlike when he voted against help for Hurricane Sandy victims",
                    "url"         => "https://amp.theguardian.com/us-news/2022/sep/30/ron-desantis-hurricane-ian-florida-sandy",
                ]
            ]
        ];

        HTTP::fake(['https://newsapi.org/*' => Http::response($data, 200),]
        );

        $this->getJson('api/v1/news')
            ->assertSuccessful()
            ->assertJsonCount(2, '*')
            ->assertJsonStructure([
                [
                    'headline',
                    'link'
                ]
            ]);
    }

    public function test_user_search_about_article()
    {
        $data = [
            "status"       => "ok",
            "totalResults" => 33,
            "articles"     => [
                (object) [
                    "source"      => (object) [
                        "id"   => null,
                        "name" => "CNBC"
                    ],
                    "author"      => "Sarah Min, Alex Harring",
                    "title"       => "Cryptoverse: Bitcoin miners get stuck in a bear pit - Reuters",
                    "description" => "Traders looked to close out a terrible week that brought the S&P 500 to a new 2022 low.",
                    "url"         => "https://www.cnbc.com/2022/09/29/stock-futures-are-flat-following-thursdays-broad-sell-off.html",
                ],
            ]
        ];

        HTTP::fake(['https://newsapi.org/*' => Http::response($data, 200),]
        );

        $this->getJson('api/v1/news?query=bitcoin')
            ->assertSuccessful()
            ->assertJsonCount(1, '*')
            ->assertJsonStructure([
                [
                    'headline',
                    'link'
                ]
            ]);
    }


}