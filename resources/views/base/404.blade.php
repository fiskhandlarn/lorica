404
@extends('layouts.default')

@section('main')
    <article class="article single-article">
        <div class="not-found-post">
            <h1 class="title">{{ trans("Page not found.") }}</h1>
            <p class="body">{!! sprintf(
                                    trans('Please check the page URL or visit our %1$shome page%2$s.'),
                                    '<a href="' . (function_exists('pll_home_url') ? pll_home_url() : home_url()) . '">',
                                    '</a>'
                                    ) !!}</p>
        </div>
    </article><!-- /article -->
@stop
