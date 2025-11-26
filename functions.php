<?php
// Functions do tema Elixan

function elixan_theme_scripts() {
    // ---------------------
    // CSS
    // ---------------------
    wp_enqueue_style(
        'main-css',
        get_template_directory_uri() . '/css/main.css',
        array(),
        filemtime(get_template_directory() . '/css/main.css')
    );

    // ---------------------
    // JS
    // ---------------------
    wp_enqueue_script(
        'translate',
        get_template_directory_uri() . '/js/translate.js',
        array('jquery'),
        filemtime(get_template_directory() . '/js/translate.js'),
        true
    );

    wp_enqueue_script(
        'language',
        get_template_directory_uri() . '/js/language.js',
        array('translate'),
        filemtime(get_template_directory() . '/js/language.js'),
        true
    );

    wp_enqueue_script(
        'modal',
        get_template_directory_uri() . '/js/modal.js',
        array('jquery'),
        filemtime(get_template_directory() . '/js/modal.js'),
        true
    );

    wp_enqueue_script(
        'accordion',
        get_template_directory_uri() . '/js/accordion.js',
        array('jquery'),
        filemtime(get_template_directory() . '/js/accordion.js'),
        true
    );

    wp_enqueue_script(
        'menu-mobile',
        get_template_directory_uri() . '/js/menu-mobile.js',
        array('jquery'),
        filemtime(get_template_directory() . '/js/menu-mobile.js'),
        true
    );

    // ---------------------
    // Caminho dos JSONs para o JS
    // ---------------------
    wp_localize_script('translate', 'ElixanLocales', array(
        'path' => get_template_directory_uri() . '/locales/'
    ));
}

add_action('wp_enqueue_scripts', 'elixan_theme_scripts');

// ---------------------
// Suporte a Menus
// ---------------------
function elixan_theme_setup() {
    // Adiciona suporte a menus customizáveis
    add_theme_support('menus');
    
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'elixan-theme'),
        'footer' => __('Menu Rodapé', 'elixan-theme')
    ));

    // Suporte a título dinâmico
    add_theme_support('title-tag');

    // Suporte a imagens destacadas
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'elixan_theme_setup');
