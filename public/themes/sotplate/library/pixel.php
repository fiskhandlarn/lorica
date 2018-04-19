<?php

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit();
}

function pixel_deploy($trackingID)
{
    if ($trackingID) {
        if (!defined('WP_DEBUG') || !WP_DEBUG) {
            add_action('wp_head', function () use ($trackingID) {
                ?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '<?php echo $trackingID; ?>');
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1"
src="https://www.facebook.com/tr?id=<?php echo $trackingID; ?>&ev=PageView
&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<?php
            }, 1000);
        }
    }
}
