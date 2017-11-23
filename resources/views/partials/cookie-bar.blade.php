@if ((function_exists('cookie_bar_accepted') && !cookie_bar_accepted()) && function_exists('the_cookie_bar'))
    <div class="info-bar-container">
        @php the_cookie_bar(trans('This website makes use of cookies to enhance browsing experience and provide additional functionality.'), trans('I understand')) @endphp
    </div>
@endif
