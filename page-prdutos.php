<?php
/*
Template Name: Produtos
*/
get_header();
?>

<!-- BANNER PRINCIPAL -->
<section class="main-hero">
  <div class="hero-image-container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/banner_produtos.png" alt="Coleção de óleos essenciais Elixan" class="hero-image" />
    <div class="hero-content">
      <h1 data-key="products_banner_title">100% REINE, NATÜRLICHE ÄTHERISCHE ÖLE</h1>
      <p data-key="products_banner_subtitle">
        Entdecken Sie unsere Kollektion und finden Sie Ihr perfektes Aroma für Wohlbefinden und Balance.
      </p>
    </div>
  </div>
</section>

<!-- LISTAGEM DE PRODUTOS -->
<section class="product-listing">
  <h2 data-key="listing_title">Unsere Topseller</h2>

  <div class="product-grid">

    <!-- PRODUTO 1 -->
    <div class="product-card">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/produto_lavendel.png" alt="Óleo Essencial de Lavanda" class="product-img" />
      <h3 data-key="product1_name">Lavendel (Lavanda)</h3>
      <p class="product-description" data-key="product1_desc">Beruhigend, entspannend und schlaffördernd.</p>
      <div class="product-meta">
        <span class="product-price">€ 14.99</span>
        <span class="product-size">10ml</span>
      </div>
      <a href="SUA_URL_SHOPIFY_PRODUTO_1" target="_blank" class="buy-button" data-key="buy_btn">JETZT KAUFEN</a>
    </div>

    <!-- PRODUTO 2 -->
    <div class="product-card">
      <span class="badge" data-key="badge_new">NEU</span>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/produto_zitrone.png" alt="Óleo Essencial de Limão" class="product-img" />
      <h3 data-key="product2_name">Zitrone (Limão)</h3>
      <p class="product-description" data-key="product2_desc">Belebt den Geist und wirkt reinigend.</p>
      <div class="product-meta">
        <span class="product-price">€ 12.50</span>
        <span class="product-size">10ml</span>
      </div>
      <a href="SUA_URL_SHOPIFY_PRODUTO_2" target="_blank" class="buy-button" data-key="buy_btn">JETZT KAUFEN</a>
    </div>

    <!-- PRODUTO 3 -->
    <div class="product-card">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/produto_minz_set.png" alt="Kit de Óleos de Menta" class="product-img" />
      <h3 data-key="product3_name">Vitalität Set</h3>
      <p class="product-description" data-key="product3_desc">
        Pfefferminz und Eukalyptus für Konzentration und Atemwege.
      </p>
      <div class="product-meta">
        <span class="product-price">€ 29.90</span>
        <span class="product-size">2x10ml</span>
      </div>
      <a href="SUA_URL_SHOPIFY_PRODUTO_3" target="_blank" class="buy-button" data-key="buy_btn">JETZT KAUFEN</a>
    </div>

  </div>
</section>

<?php get_footer(); ?>
