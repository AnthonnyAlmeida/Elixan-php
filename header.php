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

  <select class="lang-select" id="languageSelect" aria-label="Language selector">
    <option value="de" data-country="🇨🇭 Schweiz (Deutsch)">🇨🇭</option>
    <option value="de-DE" data-country="🇩🇪 Deutschland">🇩�</option>
    <option value="en" data-country="�🇬🇧 United Kingdom">🇬🇧</option>
    <option value="fr" data-country="🇫🇷 France">🇫🇷</option>
    <option value="it" data-country="🇮🇹 Italia">🇮🇹</option>
    <option value="es" data-country="🇪🇸 España">🇪🇸</option>
    <option value="pt" data-country="🇵🇹 Portugal">🇵🇹</option>
    <option value="pl" data-country="🇵🇱 Polska">🇵🇱</option>
    <option value="cs" data-country="🇨🇿 Česko">🇨🇿</option>
    <option value="hu" data-country="🇭🇺 Magyarország">🇭🇺</option>
    <option value="ro" data-country="🇷🇴 România">🇷🇴</option>
    <option value="bg" data-country="🇧🇬 България">🇧🇬</option>
    <option value="hr" data-country="🇭🇷 Hrvatska">🇭🇷</option>
    <option value="sl" data-country="🇸🇮 Slovenija">🇸🇮</option>
    <option value="sk" data-country="🇸🇰 Slovensko">🇸🇰</option>
    <option value="el" data-country="🇬🇷 Ελλάδα">🇬🇷</option>
    <option value="et" data-country="🇪🇪 Eesti">🇪🇪</option>
    <option value="lv" data-country="🇱🇻 Latvija">🇱🇻</option>
    <option value="lt" data-country="🇱🇹 Lietuva">🇱🇹</option>
    <option value="mt" data-country="🇲🇹 Malta">🇲🇹</option>
    <option value="fi" data-country="🇫🇮 Suomi">🇫🇮</option>
    <option value="sv" data-country="🇸🇪 Sverige">🇸🇪</option>
    <option value="no" data-country="🇳🇴 Norge">🇳🇴</option>
  </select>
</header>
