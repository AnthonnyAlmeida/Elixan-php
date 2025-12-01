<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  
  <!-- SEO Meta Tags -->
  <meta name="description" content="<?php 
    if (is_single() || is_page()) {
      echo wp_strip_all_tags(get_the_excerpt());
    } else {
      echo 'Elixan Aromatica - 100% reine, natürliche ätherische Öle aus der Schweiz. GMP-zertifiziert, vegan und pharmazeutische Qualität.';
    }
  ?>" />
  <meta name="keywords" content="ätherische öle, aromatherapie, schweizer qualität, natürliche öle, elixan, wellness, gesundheit" />
  <meta name="author" content="Elixan Aromatica GmbH" />
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
  
  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>" />
  <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
  <meta property="og:title" content="<?php echo is_front_page() ? get_bloginfo('name') . ' - ' . get_bloginfo('description') : wp_get_document_title(); ?>" />
  <meta property="og:description" content="<?php 
    if (is_single() || is_page()) {
      echo wp_strip_all_tags(get_the_excerpt());
    } else {
      echo 'Elixan Aromatica - 100% reine, natürliche ätherische Öle aus der Schweiz.';
    }
  ?>" />
  <meta property="og:image" content="<?php 
    if (has_post_thumbnail()) {
      echo get_the_post_thumbnail_url(get_the_ID(), 'large');
    } else {
      echo get_template_directory_uri() . '/assets/logo-elixan2.svg';
    }
  ?>" />
  <meta property="og:locale" content="de_DE" />
  <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
  
  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:url" content="<?php echo esc_url(get_permalink()); ?>" />
  <meta name="twitter:title" content="<?php echo wp_get_document_title(); ?>" />
  <meta name="twitter:description" content="<?php 
    if (is_single() || is_page()) {
      echo wp_strip_all_tags(get_the_excerpt());
    } else {
      echo 'Elixan Aromatica - 100% reine, natürliche ätherische Öle aus der Schweiz.';
    }
  ?>" />
  <meta name="twitter:image" content="<?php 
    if (has_post_thumbnail()) {
      echo get_the_post_thumbnail_url(get_the_ID(), 'large');
    } else {
      echo get_template_directory_uri() . '/assets/logo-elixan2.svg';
    }
  ?>" />
  
  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="<?php echo get_template_directory_uri(); ?>/assets/logo-elixan2.svg" />
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/logo-elixan2.svg" />
  
  <!-- Preconnect para melhor performance -->
  <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin />
  <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <!-- Schema.org JSON-LD -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Elixan Aromatica GmbH",
    "url": "<?php echo home_url(); ?>",
    "logo": "<?php echo get_template_directory_uri(); ?>/assets/logo-elixan2.svg",
    "description": "100% reine, natürliche ätherische Öle aus der Schweiz",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Sonnenstrasse 2",
      "addressLocality": "Gähwil",
      "postalCode": "9534",
      "addressCountry": "CH"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "telephone": "+41-71-931-37-35",
      "contactType": "Customer Service",
      "email": "info@elixan.ch"
    },
    "sameAs": [
      "https://www.facebook.com/elixanaromatica"
    ]
  }
  </script>
  
  <?php wp_head(); ?>
  
  <!-- ⚡ CSS CRÍTICO INLINE - FORÇA TOTAL -->
  <style id="mobile-critical">
    /* FORÇA ABSOLUTA - NÃO PODE SER SOBRESCRITO */
    @media (max-width: 880px) {
      /* Botão Hambúrguer - MÁXIMA PRIORIDADE */
      body .header button.menu-toggle,
      body header.header button.menu-toggle,
      .header button.menu-toggle,
      button.menu-toggle {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        position: relative !important;
        z-index: 10001 !important;
      }
      
      /* Menu Dropdown */
      body .header nav.nav,
      body header.header nav.nav,
      .header nav.nav,
      nav.nav {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        width: 100% !important;
        display: none !important;
        max-height: none !important;
        overflow: visible !important;
      }
      
      /* Menu Ativo */
      body .header nav.nav.active,
      body header.header nav.nav.active,
      .header nav.nav.active,
      nav.nav.active {
        display: flex !important;
        flex-direction: column !important;
        visibility: visible !important;
        opacity: 1 !important;
        background: rgba(0, 0, 0, 0.98) !important;
        z-index: 10000 !important;
        padding: 20px !important;
        min-height: auto !important;
        max-height: none !important;
        height: auto !important;
        overflow-y: auto !important;
      }
      
      /* Links dentro do menu */
      body .header nav.nav a,
      .header nav.nav a,
      nav.nav a {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        color: #fff !important;
        padding: 15px 20px !important;
        text-align: center !important;
      }
      
      /* Seletor de idioma mobile */
      body .header .lang-select,
      .header .lang-select,
      .lang-select {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
      }
    }
  </style>
</head>
<body <?php body_class(); ?>>

<header class="header">
  <div class="logo">
    <a href="<?php echo home_url(); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/logo-elixan2.svg" alt="Elixan" class="logo-img" />
      <picture>
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/bandeira_suica.webp" type="image/webp">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/bandeira_suica.png" alt="Schweiz" class="flag-img" />
      </picture>
    </a>
  </div>

  <!-- Botão Hambúrguer Mobile -->
  <button class="menu-toggle" aria-label="Toggle menu" aria-expanded="false">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </button>

  <nav class="nav">
    <a href="<?php echo home_url(); ?>" data-translate="nav_home">Home</a>
    <a href="<?php echo home_url('/produtos'); ?>" data-translate="nav_products">Produkte</a>
    <a href="<?php echo home_url('/sobre'); ?>" data-translate="nav_about">Über Uns</a>
    <a href="<?php echo home_url('/afiliados'); ?>" data-translate="nav_affiliate">Partner</a>
  </nav>

  <!-- Language Selector - Corporate Premium Style -->
  <div class="language-selector" id="languageSelector">
    <button class="language-selector__button" id="currentLanguage" aria-label="Select language" type="button">
      <span class="language-selector__flag">🇨🇭</span>
      <span class="language-selector__name">Deutsch</span>
      <svg class="language-selector__arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
        <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    
    <div class="language-selector__dropdown" id="languageDropdown">
      <div class="language-selector__search">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
          <circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.5"/>
          <path d="M11 11L14 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        <input type="text" placeholder="Search..." id="languageSearch">
      </div>
      <ul class="language-selector__list">
        <li data-lang="de" data-flag="🇨🇭" data-name="Deutsch"><span class="flag">🇨🇭</span><span class="name">Schweiz</span></li>
        <li data-lang="de-DE" data-flag="🇩🇪" data-name="Deutsch"><span class="flag">🇩🇪</span><span class="name">Deutschland</span></li>
        <li data-lang="en" data-flag="🇬🇧" data-name="English"><span class="flag">🇬🇧</span><span class="name">United Kingdom</span></li>
        <li data-lang="fr" data-flag="🇫🇷" data-name="Français"><span class="flag">🇫🇷</span><span class="name">France</span></li>
        <li data-lang="it" data-flag="🇮🇹" data-name="Italiano"><span class="flag">🇮🇹</span><span class="name">Italia</span></li>
        <li data-lang="es" data-flag="🇪🇸" data-name="Español"><span class="flag">🇪🇸</span><span class="name">España</span></li>
        <li data-lang="pt" data-flag="🇵🇹" data-name="Português"><span class="flag">🇵🇹</span><span class="name">Portugal</span></li>
        <li data-lang="pl" data-flag="🇵🇱" data-name="Polski"><span class="flag">🇵🇱</span><span class="name">Polska</span></li>
        <li data-lang="cs" data-flag="🇨🇿" data-name="Čeština"><span class="flag">🇨🇿</span><span class="name">Česko</span></li>
        <li data-lang="hu" data-flag="🇭🇺" data-name="Magyar"><span class="flag">🇭🇺</span><span class="name">Magyarország</span></li>
        <li data-lang="ro" data-flag="🇷🇴" data-name="Română"><span class="flag">🇷🇴</span><span class="name">România</span></li>
        <li data-lang="bg" data-flag="🇧🇬" data-name="Български"><span class="flag">🇧🇬</span><span class="name">България</span></li>
        <li data-lang="hr" data-flag="🇭🇷" data-name="Hrvatski"><span class="flag">🇭🇷</span><span class="name">Hrvatska</span></li>
        <li data-lang="sl" data-flag="🇸🇮" data-name="Slovenščina"><span class="flag">🇸🇮</span><span class="name">Slovenija</span></li>
        <li data-lang="sk" data-flag="🇸🇰" data-name="Slovenčina"><span class="flag">🇸🇰</span><span class="name">Slovensko</span></li>
        <li data-lang="el" data-flag="🇬🇷" data-name="Ελληνικά"><span class="flag">🇬🇷</span><span class="name">Ελλάδα</span></li>
        <li data-lang="et" data-flag="🇪🇪" data-name="Eesti"><span class="flag">🇪🇪</span><span class="name">Eesti</span></li>
        <li data-lang="lv" data-flag="🇱🇻" data-name="Latviešu"><span class="flag">🇱🇻</span><span class="name">Latvija</span></li>
        <li data-lang="lt" data-flag="🇱🇹" data-name="Lietuvių"><span class="flag">🇱🇹</span><span class="name">Lietuva</span></li>
        <li data-lang="mt" data-flag="🇲🇹" data-name="Malti"><span class="flag">🇲🇹</span><span class="name">Malta</span></li>
        <li data-lang="fi" data-flag="🇫🇮" data-name="Suomi"><span class="flag">🇫🇮</span><span class="name">Suomi</span></li>
        <li data-lang="sv" data-flag="🇸🇪" data-name="Svenska"><span class="flag">🇸🇪</span><span class="name">Sverige</span></li>
        <li data-lang="no" data-flag="🇳🇴" data-name="Norsk"><span class="flag">🇳🇴</span><span class="name">Norge</span></li>
      </ul>
    </div>
  </div>

