<?php
/**
 * Elixan Theme Functions – Versão OTIMIZADA 2025
 * Versão 100% segura contra erros is_product() / WooCommerce não carregado
 */

//
// 1. PERFORMANCE E CONFIGURAÇÕES BÁSICAS
//

require_once get_template_directory() . '/inc/performance.php';

// Desabilitar WP-Cron e Action Scheduler
add_filter('action_scheduler_queue_runner_batch_size', '__return_zero');
add_filter('action_scheduler_queue_runner_concurrent_batches', '__return_zero');

// Desabilitar Admin Bar
add_filter('show_admin_bar', '__return_false');


//
// 2. SUPORTE AO TEMA
//

function elixan_theme_setup() {
    add_theme_support('menus');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption'
    ));
}
add_action('after_setup_theme', 'elixan_theme_setup');


//
// 3. ENFILEIRAMENTO — versão sênior, agora segura e sem risco de fatal errors
//

function elixan_theme_scripts() {

    // Helper para versionamento automático
    $ver = function($file) {
        $path = get_template_directory() . $file;
        return file_exists($path) ? filemtime($path) : '1.0';
    };

    // CSS principal
    wp_enqueue_style('elixan-style', get_stylesheet_uri(), array(), $ver('/style.css'));

    //
    // 🔒 CONDICIONAIS WOO — sempre com function_exists()
    //

    $is_wc_page =
        function_exists('is_woocommerce') && is_woocommerce() ||
        function_exists('is_cart') && is_cart() ||
        function_exists('is_checkout') && is_checkout() ||
        function_exists('is_account_page') && is_account_page() ||
        function_exists('is_product') && is_product() ||
        function_exists('is_shop') && is_shop() ||
        function_exists('is_product_category') && is_product_category() ||
        function_exists('is_product_tag') && is_product_tag();

    // WooCommerce CSS (somente onde precisa)
    if ($is_wc_page) {
        wp_enqueue_style(
            'woocommerce-css',
            get_template_directory_uri() . '/css/woocommerce.css',
            array('elixan-style'),
            $ver('/css/woocommerce.css')
        );
    }

    // Single product CSS
    if (function_exists('is_product') && is_product()) {
        wp_enqueue_style(
            'single-product-css',
            get_template_directory_uri() . '/css/pages/single-product.css',
            array('elixan-style'),
            $ver('/css/pages/single-product.css')
        );
    }

    //
    // Scripts
    //

    wp_enqueue_script('simple-translate',
        get_template_directory_uri() . '/js/simple-translate.js',
        array(),
        $ver('/js/simple-translate.js'),
        true
    );

    wp_add_inline_script('simple-translate',
        'window.THEME_PATH = "' . get_template_directory_uri() . '";',
        'before'
    );

    wp_enqueue_script('language-selector',
        get_template_directory_uri() . '/js/language-selector.js',
        array(),
        $ver('/js/language-selector.js'),
        true
    );

    wp_enqueue_script('menu-mobile',
        get_template_directory_uri() . '/js/menu-mobile.js',
        array(),
        $ver('/js/menu-mobile.js'),
        true
    );

    wp_enqueue_script('modal',
        get_template_directory_uri() . '/js/modal.js',
        array(),
        $ver('/js/modal.js'),
        true
    );

    //
    // Accordion: apenas páginas específicas
    //

    if (is_page(array('sobre-nos', 'afiliados', 'programa-de-afiliados'))) {
        wp_enqueue_script('accordion',
            get_template_directory_uri() . '/js/accordion.js',
            array(),
            $ver('/js/accordion.js'),
            true
        );
    }

    //
    // WooCommerce translate
    //

    if ($is_wc_page) {
        wp_enqueue_script('woocommerce-translate',
            get_template_directory_uri() . '/js/woocommerce-translate.js',
            array('simple-translate'),
            $ver('/js/woocommerce-translate.js'),
            true
        );
    }
}

// 🔥 Correção definitiva aqui:
// wp_enqueue_scripts → roda cedo demais
// agora usamos "wp", que só roda depois de WooCommerce registrar as funções
add_action('wp', 'elixan_theme_scripts', 20);


//
// 4. CSS CRÍTICO PARA SINGLE PRODUCT
//

function elixan_single_product_critical_css() {

    if (!function_exists('is_product') || !is_product()) return;

    echo '<style id="elixan-single-product-critical">
        body.single-product{background:#111;color:#fff;padding-top:0!important;margin-top:0!important}
        body.single-product .site-main,
        body.single-product #main,
        body.single-product .content-area,
        body.single-product #primary{
            background:transparent!important;
            padding:0!important;
            margin:0!important;
        }
        .single-product .woocommerce-breadcrumb{display:none!important}
        .single-product-container{max-width:1400px;margin:120px auto 80px;padding:0 40px}
        .single-product-container .product{
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:60px;
            align-items:start
        }
        @media(max-width:768px){
            .single-product-container .product{grid-template-columns:1fr}
        }
    </style>';
}

add_action('wp_head', 'elixan_single_product_critical_css', 5);

