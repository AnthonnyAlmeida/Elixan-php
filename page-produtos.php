<?php
/*
Template Name: Produtos
*/
get_header();
?>

<!-- BANNER PRINCIPAL -->
<section class="main-hero">
  <div class="hero-image-container">
    <picture>
      <source srcset="<?php echo get_template_directory_uri(); ?>/assets/banner_produtos.webp" type="image/webp">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/banner_produtos.png" alt="Coleção de óleos essenciais Elixan" class="hero-image" loading="lazy" />
    </picture>
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
    <?php
    // Buscar produtos do WooCommerce
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 12, // Mostrar até 12 produtos
      'orderby' => 'date',
      'order' => 'DESC',
      'post_status' => 'publish'
    );
    
    $products = new WP_Query($args);
    
    if ($products->have_posts()) :
      while ($products->have_posts()) : $products->the_post();
        global $product;
        
        // Pegar informações do produto
        $product_id = get_the_ID();
        $product_link = get_permalink($product_id);
        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'medium');
        $product_title = get_the_title();
        $product_price = $product->get_price_html();
        $product_excerpt = wp_trim_words(get_the_excerpt(), 15);
        
        // Verificar se é produto novo (publicado nos últimos 30 dias)
        $is_new = (strtotime(get_the_date()) > strtotime('-30 days'));
        
        // Verificar se está em promoção
        $is_on_sale = $product->is_on_sale();
    ?>
    
    <!-- PRODUTO CARD -->
    <div class="product-card">
      <a href="<?php echo esc_url($product_link); ?>" class="product-link">
        <?php if ($is_new) : ?>
          <span class="badge badge-new" data-key="badge_new">NEU</span>
        <?php endif; ?>
        
        <?php if ($is_on_sale) : ?>
          <span class="badge badge-sale" data-key="badge_sale">SALE</span>
        <?php endif; ?>
        
        <?php if ($product_image) : ?>
          <img src="<?php echo esc_url($product_image[0]); ?>" 
               alt="<?php echo esc_attr($product_title); ?>" 
               class="product-img" 
               loading="lazy" />
        <?php else : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/assets/produto_neve.png" 
               alt="<?php echo esc_attr($product_title); ?>" 
               class="product-img" 
               loading="lazy" />
        <?php endif; ?>
        
        <h3><?php echo esc_html($product_title); ?></h3>
        
        <?php if ($product_excerpt) : ?>
          <p class="product-description"><?php echo esc_html($product_excerpt); ?></p>
        <?php endif; ?>
        
        <div class="product-meta">
          <span class="product-price"><?php echo $product_price; ?></span>
        </div>
        
        <span class="buy-button" data-key="view_product">DETAILS ANSEHEN</span>
      </a>
    </div>
    
    <?php
      endwhile;
      wp_reset_postdata();
    else :
    ?>
      <!-- FALLBACK: Se não houver produtos, mostrar mensagem -->
      <div class="no-products">
        <p data-key="no_products">Momentan sind keine Produkte verfügbar. Bitte schauen Sie später wieder vorbei.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
