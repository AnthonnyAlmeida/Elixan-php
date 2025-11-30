<?php
/**
 * Template para página individual de produto WooCommerce
 */

get_header();
?>

<style>
/* Critical CSS inline para garantir prioridade máxima */
body.single-product {
  background-color: #111 !important;
  padding-top: 0 !important;
  margin-top: 0 !important;
}
body.single-product .site-main,
body.single-product #main,
body.single-product .content-area {
  background: transparent !important;
  padding: 0 !important;
  margin: 0 !important;
}
</style>

<div class="single-product-page">
  <?php
  while (have_posts()) :
    the_post();
    global $product;
  ?>

  <!-- Product Section -->
  <section class="product-detail">
    <div class="product-container">
      
      <!-- Product Image -->
      <div class="product-image-wrapper">
        <?php
        if (has_post_thumbnail()) {
          $image_id = get_post_thumbnail_id();
          $image_url = wp_get_attachment_image_url($image_id, 'full');
          echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" class="product-main-image" />';
        } else {
          echo '<img src="' . get_template_directory_uri() . '/assets/produto_neve.png" alt="' . esc_attr(get_the_title()) . '" class="product-main-image" />';
        }
        ?>
      </div>

      <!-- Product Info -->
      <div class="product-info-wrapper">
        <h1 class="product-title"><?php the_title(); ?></h1>

        <!-- Price -->
        <div class="product-price-section">
          <?php echo $product->get_price_html(); ?>
        </div>

        <!-- Short Description -->
        <div class="product-short-description">
          <?php echo apply_filters('woocommerce_short_description', $post->post_excerpt); ?>
        </div>

        <!-- Add to Cart Form -->
        <div class="product-add-to-cart">
          <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

        <!-- Product Meta -->
        <div class="product-meta">
          <?php if ($product->get_sku()) : ?>
            <span class="sku-wrapper">
              <strong data-translate="product_sku">SKU:</strong> 
              <span class="sku"><?php echo $product->get_sku(); ?></span>
            </span>
          <?php endif; ?>

          <?php
          $categories = get_the_terms($product->get_id(), 'product_cat');
          if ($categories && !is_wp_error($categories)) :
          ?>
            <span class="categories-wrapper">
              <strong data-translate="product_category">Kategorie:</strong>
              <?php
              $cat_names = array();
              foreach ($categories as $category) {
                $cat_names[] = $category->name;
              }
              echo implode(', ', $cat_names);
              ?>
            </span>
          <?php endif; ?>
        </div>

        <!-- Back to Products -->
        <div class="back-to-products">
          <a href="<?php echo home_url('/produtos/'); ?>" class="btn-back" data-translate="back_to_products">
            ← Zurück zu Produkten
          </a>
        </div>
      </div>

    </div>
  </section>

  <!-- Product Tabs (Description, Additional Info) -->
  <section class="product-tabs-section">
    <div class="product-tabs-container">
      <?php woocommerce_output_product_data_tabs(); ?>
    </div>
  </section>

  <!-- Related Products -->
  <section class="related-products-section">
    <div class="related-products-container">
      <?php woocommerce_output_related_products(); ?>
    </div>
  </section>

  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
