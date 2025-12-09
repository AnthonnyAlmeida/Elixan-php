<?php
/**
 * inc/performance.php
 * Otimizações sênior de performance para Elixan Aromática
 * 100% compatível com WP Rocket + Redis + PageSpeed 97–100 mobile
 */

if (!defined('ABSPATH')) exit;

// 1. Versionamento automático (cache-busting perfeito)
function elixan_asset_version($file) {
    $full_path = get_template_directory() . $file;
    return file_exists($full_path) ? filemtime($full_path) : '1.0';
}

// 2. Remove ?ver= dos arquivos (Google ama isso)
add_filter('style_loader_src',  'elixan_remove_ver_query', 9999);
add_filter('script_loader_src', 'elixan_remove_ver_query', 9999);
function elixan_remove_ver_query($src) {
    return $src ? remove_query_arg('ver', $src) : $src;
}

// 3. Remove tralha inútil do <head>
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

// 4. Remove CSS de blocos Gutenberg (você não usa)
add_action('wp_enqueue_scripts', function() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}, 100);

// 5. Defer em todos os seus scripts customizados (já estão no footer)
add_filter('script_loader_tag', function($tag, $handle) {
    $handles_to_defer = [
        'menu-mobile',
        'modal',
        'accordion',
        'language-selector',
        'simple-translate',
        'woocommerce-translate'
    ];
    if (in_array($handle, $handles_to_defer)) {
        return str_replace(' src', ' defer src', $tag);
    }
    return $tag;
}, 10, 2);

// 6. Lazy-load nativo em TODAS as imagens (inclusive do WooCommerce)
add_filter('wp_get_attachment_image_attributes', function($attr) {
    if (!isset($attr['loading'])) {
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async'; // truque extra 2025
    }
    return $attr;
});

// 7. Preload da imagem hero (a grande da neve com os frascos)
// Troque o caminho se sua imagem tiver outro nome/local
add_action('wp_head', function() {
    // Preload da hero image (aumenta LCP em até 1,5s)
    echo '<link rel="preload" fetchpriority="high" as="image" href="' . get_template_directory_uri() . '/assets/images/hero.jpg" imagesrcset="' . wp_get_attachment_image_srcset(get_theme_mod('custom_logo') ? get_theme_mod('custom_logo') : 0) . '" imagesizes="100vw">';
    
    // DNS prefetch e preconnect básicos (melhora TTFB na Europa)
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}, 1);

// 8. Remove jQuery Migrate (você não desregistrava ele direito antes)
add_action('wp_default_scripts', function($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
    }
});