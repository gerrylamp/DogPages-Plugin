<?php
/**
 * Plugin Name: DogPages
 * Description: Adds a public dog photo page and admin settings for uploading it.
 * Version: 1.0
 * Author: Test Developer
 */

// Prevent direct access
defined('ABSPATH') or die('No script kiddies please!');

class DogPagesPlugin {
    private $option_name = 'dogpages_settings';
    private $cron_hook = 'dogpages_check_license_cron';

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('init', [$this, 'add_rewrite_rule']);
        add_action('template_redirect', [$this, 'render_dog_page']);
        add_action($this->cron_hook, [$this, 'check_license_key']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);

        register_activation_hook(__FILE__, [$this, 'activate_plugin']);
        register_deactivation_hook(__FILE__, [$this, 'deactivate_plugin']);
    }

    public function add_admin_menu() {
        add_menu_page(
            'DogPages Settings',
            'DogPages',
            'manage_options',
            'dogpages',
            [$this, 'settings_page'],
            'dashicons-pets',
            81
        );
    }

    public function register_settings() {
        register_setting('dogpages_settings_group', $this->option_name);
    }

    public function settings_page() {
        $options = get_option($this->option_name);
        $license_key = isset($options['license_key']) ? $options['license_key'] : '';
        $image_url = isset($options['dog_image']) ? $options['dog_image'] : '';
        ?>
        <div class="wrap">
            <h1>DogPages Settings</h1>
            <form method="post" action="options.php" enctype="multipart/form-data">
                <?php settings_fields('dogpages_settings_group'); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">License Key</th>
                        <td><input type="text" name="<?php echo $this->option_name; ?>[license_key]" value="<?php echo esc_attr($license_key); ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Dog Image</th>
                        <td>
                            <input type="text" name="<?php echo $this->option_name; ?>[dog_image]" value="<?php echo esc_attr($image_url); ?>" />
                            <input type="button" class="button" value="Upload Image" id="upload_dog_image" />
                            <?php if ($image_url): ?>
                                <div><img src="<?php echo esc_url($image_url); ?>" style="max-width: 300px;" /></div>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <script>
        jQuery(document).ready(function($) {
            $('#upload_dog_image').on('click', function(e) {
                e.preventDefault();
                var frame = wp.media({
                    title: 'Select or Upload Dog Image',
                    button: { text: 'Use this image' },
                    multiple: false
                });
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    $('input[name="<?php echo $this->option_name; ?>[dog_image]"]').val(attachment.url);
                });
                frame.open();
            });
        });
        </script>
        <?php
    }

    public function add_rewrite_rule() {
        add_rewrite_rule('^dog/?$', 'index.php?dogpage=1', 'top');
        add_rewrite_tag('%dogpage%', '1');
    }

    public function render_dog_page() {
        if (get_query_var('dogpage')) {
            $options = get_option($this->option_name);
            if (empty($options['license_key'])) {
                wp_die('License key is required.');
            }
            $image_url = isset($options['dog_image']) ? esc_url($options['dog_image']) : '';
            status_header(200);
            echo '<!DOCTYPE html><html><head><title>Dog Page</title></head><body style="text-align:center;">
                <h1>Meet our Dog!</h1>
                ' . ($image_url ? "<img src='$image_url' style='max-width:100%;height:auto;' />" : "<p>No dog uploaded.</p>") . '
                </body></html>';
            exit;
        }
    }

    public function activate_plugin() {
        $this->add_rewrite_rule();
        flush_rewrite_rules();
        if (!wp_next_scheduled($this->cron_hook)) {
            wp_schedule_event(strtotime('00:00:00'), 'daily', $this->cron_hook);
        }
    }

    public function deactivate_plugin() {
        flush_rewrite_rules();
        wp_clear_scheduled_hook($this->cron_hook);
    }

    public function check_license_key() {
        error_log('Checked license key');
    }

    public function enqueue_admin_assets($hook) {
        if ($hook !== 'toplevel_page_dogpages') return;

        wp_enqueue_media();
        wp_enqueue_script(
            'dogpages-admin-js',
            plugin_dir_url(__FILE__) . 'admin.js',
            ['jquery'],
            null,
            true
        );
    }
}

if (is_multisite()) {
    // Multisite support
    add_action('wpmu_new_blog', function ($blog_id) {
        switch_to_blog($blog_id);
        add_option('dogpages_settings', []);
        restore_current_blog();
    });
}

new DogPagesPlugin();
