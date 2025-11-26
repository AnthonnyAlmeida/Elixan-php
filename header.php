<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php bloginfo('name'); ?></title>

  <!-- CSS do tema -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <!-- i18next Library -->
  <script src="https://cdn.jsdelivr.net/npm/i18next@23.7.6/i18next.min.js"></script>

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">
  <!-- ==========================
       Logo
  ========================== -->
  <div class="logo">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/logo-elixan2.svg" alt="Elixan" class="logo-img" />
    <img src="<?php echo get_template_directory_uri(); ?>/assets/bandeira_suica.png" alt="Schweiz" class="flag-img" />
  </div>

  <!-- ==========================
       Botão Hambúrguer (Menu Mobile)
  ========================== -->
  <button class="menu-toggle" aria-label="Menu" aria-expanded="false">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </button>

  <!-- ==========================
       Navbar
  ========================== -->
  <nav class="nav">
    <a href="<?php echo home_url(); ?>" class="active" data-key="nav_home">Home</a>
    <a href="<?php echo home_url('/produtos'); ?>" data-key="nav_products">Produkte</a>
    <a href="<?php echo home_url('/sobre_nos'); ?>" data-key="nav_about">Über uns</a>
    <a href="<?php echo home_url('/afiliados'); ?>" data-key="nav_affiliate">Affiliate Programm</a>
  </nav>

  <!-- ==========================
       Seletor de Idioma
  ========================== -->
  <select id="language-selector" class="lang-select">
    <option value="de">🇪 Deutsch</option>
    <option value="pt">🇵🇹 Portugal</option>
    <option value="en">🇬🇧 English</option>
    <option value="fr">🇫🇷 Français</option>
    <option value="it">🇮🇹 Italiano</option>
    <option value="es">🇪🇸 España</option>
    <option value="cs">🇨🇿 Čeština</option>
    <option value="pl">🇵🇱 Polski</option>
    <option value="sv">🇸🇪 Svenska</option>
    <option value="fi">🇫🇮 Suomi</option>
    <option value="et">🇪🇪 Eesti</option>
    <option value="lv">🇱🇻 Latviešu</option>
    <option value="lt">🇱🇹 Lietuvių</option>
    <option value="sk">🇸🇰 Slovenčina</option>
    <option value="hu">🇭🇺 Magyar</option>
    <option value="ro">🇷🇴 Română</option>
    <option value="bg">🇧🇬 Български</option>
    <option value="el">🇬🇷 Ελληνικά</option>
    <option value="mt">🇲🇹 Malti</option>
    <option value="sl">🇸🇮 Slovenščina</option>
    <option value="hr">🇭🇷 Hrvatski</option>
    <option value="no">🇳🇴 Norsk</option>
  </select>
</header>
