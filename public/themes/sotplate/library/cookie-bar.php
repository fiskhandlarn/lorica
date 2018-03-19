<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

if (!function_exists('cookie_bar_get_rest_url')) {
    function cookie_bar_get_rest_url()
    {
        return get_rest_url(null, '/cookie-bar/accept', 'rest');
    }
}

if (!function_exists('cookie_bar_accepted')) {
    function cookie_bar_accepted()
    {
        return (isset($_COOKIE['cookie-bar-accepted']) && $_COOKIE['cookie-bar-accepted']);
    }
}

if (!function_exists('the_cookie_bar')) {
    function the_cookie_bar($message, $button)
    {
        if (!cookie_bar_accepted()) {
            ?>
<div id="cookie-bar" class="info-bar -cookie-bar -active">
    <form action="<?php echo esc_url(cookie_bar_get_rest_url()); ?>" method="post">
        <input type="hidden" name="redirect" value="<?php echo esc_url(cookie_bar_get_rest_url()); ?>">
        <p class="message"><?php echo esc_html($message); ?></p>
        <input class="button" type="submit" value="<?php echo esc_attr($button); ?>">
    </form>
    <script type="text/javascript">
        (function() {
            var button = document.querySelector('#cookie-bar .button');
            if (button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    var bar = document.querySelector('#cookie-bar');
                    if (bar && bar.classList.contains('-active')) {
                        bar.classList.remove('-active');

                        setTimeout(function() {
                            if (bar && bar.parentNode) {
                                bar.parentNode.removeChild(bar);
                            }
                        }, 1000);
                    }

                    var request = new XMLHttpRequest();
                    request.open('GET', <?php echo json_encode(cookie_bar_get_rest_url()) ?>, true);
                    request.send();
                    return false;
                }, false);
            }
        }());
    </script>
</div>
<?php
        }
    }
}

add_action('rest_api_init', function () {
    if (function_exists('register_rest_route')) {
        $methods = ['GET', 'POST'];
        foreach (['GET', 'POST'] as $method) {
            register_rest_route('cookie-bar', 'accept(/.*)?', [
                'methods' => $method,
                'callback' => function ($data) {
                    $domain = COOKIE_DOMAIN;
                    if (!$domain) {
                        $domain = str_replace("https://", "", str_replace("http://", "", home_url()));
                    }
                    setcookie('cookie-bar-accepted', "1", time() + (30 * DAY_IN_SECONDS), COOKIEPATH, $domain, is_ssl());
                    if (isset($data['redirect'])) {
                        header_remove('Content-Type');
                        header(sprintf('Location: %s', home_url('/', is_ssl())));
                        exit();
                    }
                    return new WP_REST_Response([]);
                },
                'args' => [
                    'referer'
                ],
            ]);
        }
    }
});
