<?php
// General theme functions, hooks and alterations.
ini_set('error_reporting', E_ALL);

// Add theme support 
add_theme_support('menus');
add_theme_support('post-thumbnails');

function my_theme_add_excerpts_to_pages() {
  add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'my_theme_add_excerpts_to_pages' );

// Add custom image sizes 
$image_sizes = [
  ['article-listing', 500, 500, 'center'],
  ['fifty-fifty', 640, 450, 'center', 'left'],
  ['hero', 700, 700, 'center', 'center'],
];

foreach ($image_sizes as $size) {
  add_image_size(...$size);
}

// Strip default WP menu classes
add_filter('nav_menu_css_class', function($var) {
  return is_array($var) ? array_intersect($var, ['current-menu-item', 'custom-cta', 'menu-item-has-children']) : '';
}, 50, 1);
add_filter('nav_menu_item_id', function($var) {
  return is_array($var) ? array_intersect($var, ['current-menu-item', 'custom-cta', 'menu-item-has-children']) : '';
}, 100, 1);

// Disable all widget areas
add_filter('sidebars_widgets', function($sidebars_widgets) {
  return array(false);
});

// Allow JSON files to be uploaded to media folder 
add_filter('upload_mimes', function($types) {
  return array_merge($types, ['json' => 'text/plain']);
});

// Remove tags edit page
add_action('admin_menu', function() {
  remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
});

// Remove tags support from posts
add_action('init', function() {
  unregister_taxonomy_for_object_type('post_tag', 'post');
});

add_theme_support( 'title-tag' );

// Change the WordPress login logo
function my_custom_login_logo() { ?>
    <style type="text/css">
        #login h1 a {
            background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png');
            height: 100px;
            width: 300px;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action('login_enqueue_scripts', 'my_custom_login_logo');

// Change login logo link to your site instead of WordPress.org
function my_custom_login_url() {
    return home_url();
}
add_filter('login_headerurl', 'my_custom_login_url');

// Change login logo title text
function my_custom_login_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'my_custom_login_title');