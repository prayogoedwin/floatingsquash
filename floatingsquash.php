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
    // Bootstrap CSS
    wp_enqueue_style('floatingsquash-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
    
    // Font Awesome for icons
    wp_enqueue_style('floatingsquash-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    
    // Plugin CSS
    wp_enqueue_style('floatingsquash-style', plugin_dir_url(__FILE__) . 'css/style.css');
    
    // Bootstrap JS Bundle with Popper
    wp_enqueue_script('floatingsquash-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);
    
    // Plugin JS
    wp_enqueue_script('floatingsquash-script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery', 'floatingsquash-bootstrap'), '1.0', true);
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

    register_setting('floatingsquash_settings_group', 'floatingsquash_facebook_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_instagram_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_x_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_tiktok_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_fbm_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_wa_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_tele_url');
    register_setting('floatingsquash_settings_group', 'floatingsquash_email_url');

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
                    </td>
                </tr>

                 <tr valign="top">
                    <th scope="row">Facebook</th>
                    <td>
                        <input type="url" name="floatingsquash_facebook_url" value="<?php echo esc_url(get_option('floatingsquash_facebook_url', '#')); ?>" class="regular-text" />
                    </td>
                 </tr>

                 <tr valign="top">
                    <th scope="row">Instagram</th>
                    <td>
                        <input type="url" name="floatingsquash_instagram_url" value="<?php echo esc_url(get_option('floatingsquash_instagram_url', '#')); ?>" class="regular-text" />
                    </td>
                 </tr>

                 <tr valign="top">
                    <th scope="row">Twitter / X</th>
                    <td>
                        <input type="url" name="floatingsquash_x_url" value="<?php echo esc_url(get_option('floatingsquash_x_url', '#')); ?>" class="regular-text" />
                    </td>
                 </tr>

                 <tr valign="top">
                    <th scope="row">Tiktok</th>
                    <td>
                        <input type="url" name="floatingsquash_tiktok_url" value="<?php echo esc_url(get_option('floatingsquash_tiktok_url', '#')); ?>" class="regular-text" />
                    </td>
                 </tr>

                  <tr valign="top">
                    <th scope="row">FB Messenger</th>
                    <td>
                        <input type="url" name="floatingsquash_fbm_url" value="<?php echo esc_url(get_option('floatingsquash_fbm_url', '#')); ?>" class="regular-text" />
                    </td>
                 </tr>

                 <tr valign="top">
                    <th scope="row">Whatsapp</th>
                    <td>
                        <input type="url" name="floatingsquash_wa_url" value="<?php echo esc_url(get_option('floatingsquash_wa_url', '#')); ?>" class="regular-text" />
                    </td>
                 </tr>

                 <tr valign="top">
                    <th scope="row">Telegram</th>
                    <td>
                        <input type="url" name="floatingsquash_tele_url" value="<?php echo esc_url(get_option('floatingsquash_tele_url', '#')); ?>" class="regular-text" />
                    </td>
                 </tr>

                 <tr valign="top">
                    <th scope="row">Email</th>
                    <td>
                        <input type="url" name="floatingsquash_email_url" value="<?php echo esc_url(get_option('floatingsquash_email_url', '#')); ?>" class="regular-text" />
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
    // Get all the URLs from options
    $popular_url = esc_url(get_option('floatingsquash_popular_url', 'https://ashesofamericanmovie.com/genre/movie-populer/'));
    $series_url = esc_url(get_option('floatingsquash_series_url', 'https://ashesofamericanmovie.com/genre/series-populer/'));
    $movie_url = esc_url(get_option('floatingsquash_movie_url', '#'));
    $search_url = esc_url(get_option('floatingsquash_search_url', 'https://ashesofamericanmovie.com/?s='));
    
    $facebook_url = esc_url(get_option('floatingsquash_facebook_url', '#'));
    $instagram_url = esc_url(get_option('floatingsquash_instagram_url', '#'));
    $x_url = esc_url(get_option('floatingsquash_x_url', '#'));
    $tiktok_url = esc_url(get_option('floatingsquash_tiktok_url', '#'));
    $fbm_url = esc_url(get_option('floatingsquash_fbm_url', '#'));
    $wa_url = esc_url(get_option('floatingsquash_wa_url', '#'));
    $tele_url = esc_url(get_option('floatingsquash_tele_url', '#'));
    $email_url = esc_url(get_option('floatingsquash_email_url', 'mailto:example@example.com'));
    
    // Get current page URL
    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    // Check which menu should be active
    $popular_active = (strpos($current_url, $popular_url) !== false) ? 'active' : '';
    $series_active = (strpos($current_url, $series_url) !== false) ? 'active' : '';
    $movie_active = (strpos($current_url, $movie_url) !== false && $movie_url != '#') ? 'active' : '';
    $search_active = (strpos($current_url, $search_url) !== false) ? 'active' : '';
    ?>
    <div class="floatingsquash-container d-lg-none">
        <!-- Main Floating Menu -->
        <div class="floatingsquash-menu d-flex bg-dark text-white fixed-bottom py-2 shadow-lg">
            <a href="<?php echo $popular_url; ?>" class="floatingsquash-item flex-fill text-center text-decoration-none text-white <?php echo $popular_active; ?>">
                <i class="fas fa-star d-block fs-5 mb-1"></i>
                <span class="small">Terpopuler</span>
            </a>
            <a href="<?php echo $series_url; ?>" class="floatingsquash-item flex-fill text-center text-decoration-none text-white <?php echo $series_active; ?>">
                <i class="fas fa-heart d-block fs-5 mb-1"></i>
                <span class="small">Series</span>
            </a>
            <a href="<?php echo $movie_url; ?>" class="floatingsquash-item flex-fill text-center text-decoration-none text-white <?php echo $movie_active; ?>">
                <i class="fas fa-film d-block fs-5 mb-1"></i>
                <span class="small">Film</span>
            </a>
            <a href="<?php echo $search_url; ?>" class="floatingsquash-item flex-fill text-center text-decoration-none text-white <?php echo $search_active; ?>">
                <i class="fas fa-search d-block fs-5 mb-1"></i>
                <span class="small">Pencarian</span>
            </a>
            <a href="#" class="floatingsquash-item flex-fill text-center text-decoration-none text-white floatingsquash-share-trigger" data-bs-toggle="modal" data-bs-target="#floatingsquashShareModal">
                <i class="fas fa-share-alt d-block fs-5 mb-1"></i>
                <span class="small">Share</span>
            </a>
        </div>

        <!-- Share Modal -->
        <div class="modal fade" id="floatingsquashShareModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-bottom">
                <div class="modal-content rounded-top-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fs-6 fw-bold">Bagikan Melalui</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-0">
                        <div class="row g-3">
                            <div class="col-3 text-center">
                                <a href="<?php echo $facebook_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-primary text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fab fa-facebook-f fs-5"></i>
                                    </div>
                                    <span class="small text-dark">Facebook</span>
                                </a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="<?php echo $instagram_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-instagram text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fab fa-instagram fs-5"></i>
                                    </div>
                                    <span class="small text-dark">Instagram</span>
                                </a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="<?php echo $x_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-dark text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fab fa-twitter fs-5"></i>
                                    </div>
                                    <span class="small text-dark">Twitter</span>
                                </a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="<?php echo $tiktok_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-black text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fab fa-tiktok fs-5"></i>
                                    </div>
                                    <span class="small text-dark">TikTok</span>
                                </a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="<?php echo $fbm_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-primary text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fab fa-facebook-messenger fs-5"></i>
                                    </div>
                                    <span class="small text-dark">Messenger</span>
                                </a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="<?php echo $wa_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-success text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fab fa-whatsapp fs-5"></i>
                                    </div>
                                    <span class="small text-dark">WhatsApp</span>
                                </a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="<?php echo $tele_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-info text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fab fa-telegram fs-5"></i>
                                    </div>
                                    <span class="small text-dark">Telegram</span>
                                </a>
                            </div>
                            <div class="col-3 text-center">
                                <a href="<?php echo $email_url; ?>" target="_blank" class="d-block text-decoration-none">
                                    <div class="bg-secondary text-white rounded-circle p-3 mx-auto mb-2" style="width: 50px; height: 50px;">
                                        <i class="fas fa-envelope fs-5"></i>
                                    </div>
                                    <span class="small text-dark">Email</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom CSS to complement Bootstrap */
        .modal-dialog-bottom {
            margin: 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            max-width: 100%;
        }
        
        .modal-dialog-bottom .modal-content {
            border-radius: 1rem 1rem 0 0;
            border: none;
        }
        
        .bg-instagram {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }
        
        .floatingsquash-item {
            transition: all 0.2s;
        }
        
        .floatingsquash-item:hover {
            transform: translateY(-3px);
        }
        
        /* Style for active menu item */
        .floatingsquash-item.active {
            color: #ffc107 !important;
        }
        
        .floatingsquash-item.active i {
            color: #ffc107 !important;
        }
    </style>
    <?php 
}
add_action('wp_footer', 'floatingsquash_display_menu');
?>