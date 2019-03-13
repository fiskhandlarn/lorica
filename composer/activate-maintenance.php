<?php
file_put_contents(dirname(__DIR__) . '/public/wordpress/.maintenance', '<?php $upgrading = time(); ?>');
