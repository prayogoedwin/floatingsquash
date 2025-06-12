<?php
/*
Plugin Name: FloatingSquash
Plugin URI: https://ashesofamericanmovie.com/
Description: Floating menu untuk mobile dengan 5 tombol aksi.
Version: 1.0
Author: Edwin (Astama)
Author URI: https://ashesofamericanmovie.com/
License: GPLv2 or later
Text Domain: floatingsquash
*/

// Enqueue styles and scripts
function floatingsquash_enqueue_assets() {
    // Font Awesome for icons
    wp_enqueue_style('floatingsquash-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    
    // Plugin CSS
    wp_enqueue_style('floatingsquash-style', plugin_dir_url(__FILE__) . 'css/style.css');
    
    // Plugin JS
    wp_enqueue_script('floatingsquash-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'floatingsquash_enqueue_assets');


// Add admin menu
function floatingsquash_add_admin_menu() {
    add_menu_page(
        'FloatingSquash Settings',
        'FloatingSquash',
        'manage_options',
        'floatingsquash-settings',
        'floatingsquash_settings_page',
        'dashicons-menu-alt'
    );
}
add_action('admin_menu', 'floatingsquash_add_admin_menu');

// Register settings
function floatingsquash_register_settings() {
    register_setting('floatingsquash_settings_group', 'floatingsquash_popular_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_series_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_movie_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_search_url');
}
add_action('admin_init', 'floatingsquash_register_settings');

// Settings page content
function floatingsquash_settings_page() {
    ?>
    <div class="wrap">
        <h1>FloatingSquash Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('floatingsquash_settings_group'); ?>
            <?php do_settings_sections('floatingsquash_settings_group'); ?>
            
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">URL Menu Terpopuler</th>
                    <td>
                        <input type="url" name="floatingsquash_popular_url" value="<?php echo esc_url(get_option('floatingsquash_popular_url', 'https://ashesofamericanmovie.com/genre/movie-populer/')); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">URL Menu Series</th>
                    <td>
                        <input type="url" name="floatingsquash_series_url" value="<?php echo esc_url(get_option('floatingsquash_series_url', 'https://ashesofamericanmovie.com/genre/series-populer/')); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">URL Menu Film</th>
                    <td>
                        <input type="url" name="floatingsquash_movie_url" value="<?php echo esc_url(get_option('floatingsquash_movie_url', '#')); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">URL Menu Pencarian</th>
                    <td>
                        <input type="url" name="floatingsquash_search_url" value="<?php echo esc_url(get_option('floatingsquash_search_url', 'https://ashesofamericanmovie.com/?s=')); ?>" class="regular-text" />
                        <p class="description">URL untuk halaman pencarian (biarkan "?s=" di akhir untuk fungsi pencarian)</p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Create the floating menu HTML
function floatingsquash_display_menu() {
    ?>
    <div class="floatingsquash-container">
        <div class="floatingsquash-menu">

            <a href="<?php echo $popular_url; ?>" class="floatingsquash-item">
                <i class="fas fa-star"></i>
                <span>Terpopuler</span>
            </a>
            <a href="<?php echo $series_url; ?>" class="floatingsquash-item">
                <i class="fas fa-heart"></i>
                <span>Series</span>
            </a>
            <a href="<?php echo $movie_url; ?>" class="floatingsquash-item">
                <i class="fas fa-film"></i>
                <span>Film</span>
            </a>
            <a href="<?php echo $search_url; ?>" class="floatingsquash-item">
                <i class="fas fa-filter"></i>
                <span>Pencarian</span>
            </a>
           
            <div class="floatingsquash-item floatingsquash-share-trigger">
                <i class="fas fa-share-alt"></i>
                <span>Share</span>
            </div>
        </div>
        
        <!-- Share Popup -->
        <div class="floatingsquash-share-popup">
            <div class="floatingsquash-share-content">
                <h4>Bagikan ke:</h4>
                <div class="floatingsquash-share-buttons">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://ashesofamericanmovie.com" target="_blank" class="floatingsquash-share-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="floatingsquash-share-btn instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/" target="_blank" class="floatingsquash-share-btn tiktok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
                <button class="floatingsquash-close-share">&times;</button>
            </div>
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'floatingsquash_display_menu');

// Create necessary directories and files on activation
function floatingsquash_activate() {
    // Create CSS directory and file if not exists
    if (!file_exists(plugin_dir_path(__FILE__) . 'css')) {
        wp_mkdir_p(plugin_dir_path(__FILE__) . 'css');
    }
    
    if (!file_exists(plugin_dir_path(__FILE__) . 'css/style.css')) {
        file_put_contents(plugin_dir_path(__FILE__) . 'css/style.css', floatingsquash_get_default_css());
    }
    
    // Create JS directory and file if not exists
    if (!file_exists(plugin_dir_path(__FILE__) . 'js')) {
        wp_mkdir_p(plugin_dir_path(__FILE__) . 'js');
    }
    
    if (!file_exists(plugin_dir_path(__FILE__) . 'js/script.js')) {
        file_put_contents(plugin_dir_path(__FILE__) . 'js/script.js', floatingsquash_get_default_js());
    }
}
register_activation_hook(__FILE__, 'floatingsquash_activate');

// Default CSS content
function floatingsquash_get_default_css() {
    return '
    /* FloatingSquash Mobile Menu */
    .floatingsquash-container {
        display: none;
    }
    
    @media only screen and (max-width: 768px) {
        .floatingsquash-container {
            display: block;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }
        
        .floatingsquash-menu {
            display: flex;
            background: #1a1a1a;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.2);
        }
        
        .floatingsquash-item {
            flex: 1;
            text-align: center;
            padding: 10px 5px;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            transition: all 0.3s ease;
        }
        
        .floatingsquash-item i {
            display: block;
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .floatingsquash-item:hover {
            background: #333;
        }
        
        .floatingsquash-share-popup {
            display: none;
            position: fixed;
            bottom: 70px;
            left: 0;
            right: 0;
            background: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 -2px 15px rgba(0,0,0,0.2);
            z-index: 9998;
        }
        
        .floatingsquash-share-content {
            position: relative;
        }
        
        .floatingsquash-share-content h4 {
            margin: 0 0 15px 0;
            text-align: center;
            color: #333;
        }
        
        .floatingsquash-share-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        
        .floatingsquash-share-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            font-size: 18px;
            text-decoration: none;
        }
        
        .floatingsquash-share-btn.facebook {
            background: #3b5998;
        }
        
        .floatingsquash-share-btn.instagram {
            background: #e1306c;
        }
        
        .floatingsquash-share-btn.tiktok {
            background: #000;
        }
        
        .floatingsquash-close-share {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff4757;
            color: white;
            border: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
        }
    }
    ';
}

// Default JS content
function floatingsquash_get_default_js() {
    return '
    jQuery(document).ready(function($) {
        // Toggle share popup
        $(".floatingsquash-share-trigger").on("click", function() {
            $(".floatingsquash-share-popup").fadeIn();
        });
        
        // Close share popup
        $(".floatingsquash-close-share").on("click", function() {
            $(".floatingsquash-share-popup").fadeOut();
        });
        
        // Close when clicking outside
        $(document).on("click", function(e) {
            if (!$(e.target).closest(".floatingsquash-share-popup, .floatingsquash-share-trigger").length) {
                $(".floatingsquash-share-popup").fadeOut();
            }
        });
    });
    ';
}
?>