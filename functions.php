<?php
// Functions OTIMIZADO - COM tradução LEVE

// Desabilitar WP-Cron
add_filter('action_scheduler_queue_runner_batch_size', '__return_zero');
add_filter('action_scheduler_queue_runner_concurrent_batches', '__return_zero');

function elixan_theme_scripts() {
    // CSS Principal (style.css importa main.css automaticamente)
    // Versão fixa para permitir cache do navegador
    wp_enqueue_style('elixan-style', get_stylesheet_uri(), array(), '6.0.1');
    
    // WooCommerce CSS (apenas nas páginas da loja)
    if (class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page())) {
        wp_enqueue_style('woocommerce-css', get_template_directory_uri() . '/css/woocommerce.css', array('elixan-style'), '6.0.1');
    }
    
    // Single Product CSS (página individual de produto)
    if (is_product()) {
        wp_enqueue_style('single-product-css', get_template_directory_uri() . '/css/pages/single-product.css', array('elixan-style'), '6.0.1');
    }
    
    // WooCommerce Translation (páginas de produtos)
    if (class_exists('WooCommerce') && (is_product() || is_shop() || is_product_category() || is_product_tag())) {
        wp_enqueue_script('woocommerce-translate', get_template_directory_uri() . '/js/woocommerce-translate.js', array('simple-translate'), '6.0.1', true);
    }
    
    // JavaScript LEVE - Sistema de tradução otimizado (1.6KB)
    // Carrega no footer (true) para garantir que DOM esteja pronto
    wp_enqueue_script('simple-translate', get_template_directory_uri() . '/js/simple-translate.js', array(), '6.0.1', true);
    
    // Adiciona inline script para garantir THEME_PATH
    wp_add_inline_script('simple-translate', 'window.THEME_PATH = "' . get_template_directory_uri() . '";', 'before');
    
    // Language Selector - Flag Toggle
    wp_enqueue_script('language-selector', get_template_directory_uri() . '/js/language-selector.js', array(), '6.0.1', true);
    
    // Menu Mobile (hambúrguer)
    wp_enqueue_script('menu-mobile', get_template_directory_uri() . '/js/menu-mobile.js', array(), '6.0.1', true);
    
    // Modal (página de afiliados)
    wp_enqueue_script('modal', get_template_directory_uri() . '/js/modal.js', array(), '6.0.1', true);
    
    // Accordion (se usado em alguma página)
    if (is_page('sobre-nos') || is_page('afiliados')) {
        wp_enqueue_script('accordion', get_template_directory_uri() . '/js/accordion.js', array(), '6.0.1', true);
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

// CSS Crítico para Single Product - Forçar no HEAD
function elixan_single_product_critical_css() {
    if (is_product()) {
        ?>
        <style id="elixan-single-product-critical">
        body.single-product,
        body.woocommerce-page.single-product,
        body.woocommerce.single-product {
            background-color: #111 !important;
            color: #fff !important;
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        body.single-product .site-main,
        body.single-product #main,
        body.single-product .content-area,
        body.single-product #primary {
            background: transparent !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .single-product .woocommerce-breadcrumb {
            display: none !important;
        }
        .single-product-container {
            max-width: 1400px;
            margin: 120px auto 80px;
            padding: 0 40px;
        }
        .single-product-container #product-39,
        .single-product-container .product {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: start;
        }
        /* FIX: Forçar tamanho correto das imagens do header */
        body.single-product .logo-img,
        body.single-product .header .logo img {
            height: 42px !important;
            width: auto !important;
            max-width: none !important;
        }
        body.single-product .flag-img,
        body.single-product .header .flag-container img {
            height: 36px !important;
            width: auto !important;
            max-width: none !important;
        }
        body.single-product .header {
            padding: 14px 20px !important;
        }
        </style>
        <?php
    }
}
add_action('wp_head', 'elixan_single_product_critical_css', 999);
