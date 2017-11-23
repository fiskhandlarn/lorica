@extends('layouts.default')

@section('main')
    <article class="article">
        @if (have_posts())
            @include('partials/post')
        @endif
    </article><!-- /article -->
@stop
