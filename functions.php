<?php
// Functions OTIMIZADO - COM tradução LEVE

// Desabilitar WP-Cron
add_filter('action_scheduler_queue_runner_batch_size', '__return_zero');
add_filter('action_scheduler_queue_runner_concurrent_batches', '__return_zero');

function elixan_theme_scripts() {
    // CSS Principal (style.css importa main.css automaticamente)
    // Versão com timestamp para quebrar cache DEFINITIVAMENTE
    wp_enqueue_style('elixan-style', get_stylesheet_uri(), array(), '6.0.0.' . time());
    
    // WooCommerce CSS (apenas nas páginas da loja)
    if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
        wp_enqueue_style('woocommerce-css', get_template_directory_uri() . '/css/woocommerce.css', array('main-css'), time());
    }
    
    // Single Product CSS (página individual de produto)
    if (is_product()) {
        wp_enqueue_style('single-product-css', get_template_directory_uri() . '/css/pages/single-product.css', array('elixan-style'), time());
    }
    
    // JavaScript LEVE - Sistema de tradução otimizado (1.6KB)
    // Carrega no footer (true) para garantir que DOM esteja pronto
    wp_enqueue_script('simple-translate', get_template_directory_uri() . '/js/simple-translate.js', array(), time(), true);
    
    // Adiciona inline script para garantir THEME_PATH
    wp_add_inline_script('simple-translate', 'window.THEME_PATH = "' . get_template_directory_uri() . '";', 'before');
    
    // Menu Mobile (hambúrguer)
    wp_enqueue_script('menu-mobile', get_template_directory_uri() . '/js/menu-mobile.js', array(), time(), true);
    
    // Modal (página de afiliados)
    wp_enqueue_script('modal', get_template_directory_uri() . '/js/modal.js', array(), time(), true);
    
    // Accordion (se usado em alguma página)
    if (is_page('sobre-nos') || is_page('afiliados')) {
        wp_enqueue_script('accordion', get_template_directory_uri() . '/js/accordion.js', array(), time(), true);
    }
}
add_action('wp_enqueue_scripts', 'elixan_theme_scripts');

// Desabilitar scripts desnecessários do WordPress
function elixan_remove_all_scripts() {
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'elixan_remove_all_scripts', 999);

// Desabilitar Admin Bar
add_filter('show_admin_bar', '__return_false');

// Suporte básico ao tema
function elixan_theme_setup() {
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    // Suporte ao WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'elixan_theme_setup');
