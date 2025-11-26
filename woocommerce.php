<?php
/**
 * Template para páginas do WooCommerce
 */
get_header();
?>

<!-- BANNER DA LOJA -->
<section class="main-hero shop-hero">
  <div class="hero-image-container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/banner_produtos.png" alt="Elixan Shop" class="hero-image" />
    <div class="hero-content">
      <h1 data-key="shop_banner_title"></h1>
      <p data-key="shop_banner_subtitle"></p>
    </div>
  </div>
</section>

<!-- CONTEÚDO DA LOJA -->
<div class="woocommerce-container">
    <?php woocommerce_content(); ?>
</div>

<?php get_footer(); ?>
