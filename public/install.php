<?php
if (!function_exists('wp_install_defaults')) {
    function wp_install_defaults($user_id)
    {
        global $wpdb, $wp_rewrite, $table_prefix;

        // Default category
        $cat_name = __('Uncategorized');
        /* translators: Default category slug */
        $cat_slug = sanitize_title(_x('Uncategorized', 'Default category slug'));

        if (global_terms_enabled()) {
            $cat_id = $wpdb->get_var($wpdb->prepare("SELECT cat_ID FROM {$wpdb->sitecategories} WHERE category_nicename = %s", $cat_slug));
            if ($cat_id == null) {
                $wpdb->insert($wpdb->sitecategories, [
                    'cat_ID' => 0,
                    'cat_name' => $cat_name,
                    'category_nicename' => $cat_slug,
                    'last_updated' => current_time('mysql', true),
                ]);
                $cat_id = $wpdb->insert_id;
            }
            update_option('default_category', $cat_id);
        } else {
            $cat_id = 1;
        }

        $wpdb->insert($wpdb->terms, [
            'term_id' => $cat_id,
            'name' => $cat_name,
            'slug' => $cat_slug,
            'term_group' => 0,
        ]);

        $wpdb->insert($wpdb->term_taxonomy, [
            'term_id' => $cat_id,
            'taxonomy' => 'category',
            'description' => '',
            'parent' => 0,
            'count' => 1,
        ]);

        // Set up default widgets for default theme.
        update_option('widget_search', [2 => ['title' => ''], '_multiwidget' => 1]);
        update_option('widget_recent-posts', [2 => ['title' => '', 'number' => 5], '_multiwidget' => 1]);
        update_option('widget_recent-comments', [2 => ['title' => '', 'number' => 5], '_multiwidget' => 1]);
        update_option('widget_archives', [2 => ['title' => '', 'count' => 0, 'dropdown' => 0], '_multiwidget' => 1]);
        update_option('widget_categories', [2 => ['title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0], '_multiwidget' => 1]);
        update_option('widget_meta', [2 => ['title' => ''], '_multiwidget' => 1]);
        update_option('sidebars_widgets', ['wp_inactive_widgets' => [], 'sidebar-1' => [0 => 'search-2', 1 => 'recent-posts-2', 2 => 'recent-comments-2', 3 => 'archives-2', 4 => 'categories-2', 5 => 'meta-2'], 'sidebar-2' => [], 'sidebar-3' => [], 'array_version' => 3]);

        if (!is_multisite()) {
            update_user_meta($user_id, 'show_welcome_panel', 1);
        } elseif (!is_super_admin($user_id) && ! metadata_exists('user', $user_id, 'show_welcome_panel')) {
            update_user_meta($user_id, 'show_welcome_panel', 2);
        }

        if (is_multisite()) {
            // Flush rules to pick up the new page.
            $wp_rewrite->init();
            $wp_rewrite->flush_rules();

            $user = new WP_User($user_id);
            $wpdb->update($wpdb->options, ['option_value' => $user->user_email], ['option_name' => 'admin_email']);

            // Remove all perms except for the login user.
            $wpdb->query($wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix.'user_level'));
            $wpdb->query($wpdb->prepare("DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix.'capabilities'));

            // Delete any caps that snuck into the previously active blog. (Hardcoded to blog 1 for now.) TODO: Get previous_blog_id.
            if (!is_super_admin($user_id) && $user_id != 1) {
                $wpdb->delete($wpdb->usermeta, ['user_id' => $user_id , 'meta_key' => $wpdb->base_prefix.'1_capabilities']);
            }
        }
    }
}

if (class_exists('ITSEC_Modules')) {
    // better-wp-security's default value for "Disable File Editor" is true,
    // this leads to better-wp-security trying to add code at the top of wp-config.php,
    // thus breaking declare(strict_types=1); .
    // also, DISALLOW_FILE_EDIT is already handled by WordPlate, so let's disable
    // better-wp-security handling this:
    ITSEC_Modules::get_instance()->set_setting('wordpress-tweaks', 'file_editor', false);



    // default values
    ITSEC_Modules::get_instance()->deactivate('backup');

    ITSEC_Modules::get_instance()->set_setting('global', 'lockout_white_list', ['62.20.18.146']); // office ip

    ITSEC_Modules::get_instance()->activate('404-detection');

    ITSEC_Modules::get_instance()->set_setting('ban-users', 'default', true);

    ITSEC_Modules::get_instance()->activate('file-change');

    ITSEC_Modules::get_instance()->set_setting('network-brute-force', 'api_key', 'pBY304rg8Fqg7JWIT6SL1576MHX1PaIK');
    ITSEC_Modules::get_instance()->set_setting('network-brute-force', 'api_secret', '3G52yVN4u7Ytb8EK9562vyBPGUFrdpV5i248317L3S78p4xcut25kO8j6986Y119Vs3t4fVV8q3C60j4U9DZku2fr9n78SlhKZJFbupl936lj4HT0yobw06iI520u89c');
    ITSEC_Modules::get_instance()->set_setting('network-brute-force', 'api_nag', false);

    ITSEC_Modules::get_instance()->activate('system-tweaks');
    ITSEC_Modules::get_instance()->set_setting('system-tweaks', 'protect_files', true);
    ITSEC_Modules::get_instance()->set_setting('system-tweaks', 'directory_browsing', true);
    ITSEC_Modules::get_instance()->set_setting('system-tweaks', 'suspicious_query_strings', true);
    ITSEC_Modules::get_instance()->set_setting('system-tweaks', 'write_permissions', true);
    ITSEC_Modules::get_instance()->set_setting('system-tweaks', 'uploads_php', true);

    ITSEC_Modules::get_instance()->set_setting('hide-backend', 'enabled', true);
    ITSEC_Modules::get_instance()->set_setting('hide-backend', 'slug', 'lorica-admin');
    ITSEC_Modules::get_instance()->set_setting('hide-backend', 'theme_compat', false);
}
