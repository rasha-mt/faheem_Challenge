<?php
namespace Domains\Actions;

class NewsApiSourcing
{
    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        $src1 = app(NewDataSource::class);
        $src2 = app(NewDataSource::class);
         dd($src1);


    }

}