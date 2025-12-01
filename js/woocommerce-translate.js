/**
 * WooCommerce Translation Script - ULTRA COMPLETO
 * Traduz ABSOLUTAMENTE TODOS os textos do WooCommerce em 22 idiomas
 */

let isTranslating = false;
let translationsCache = {};

function translateWooCommerce() {
  if (isTranslating) return;
  isTranslating = true;

  const lang = localStorage.getItem('selectedLanguage') || localStorage.getItem('idioma') || 'de';
  
  // Usa cache se já carregou
  if (translationsCache[lang]) {
    applyAllTranslations(translationsCache[lang], lang);
    isTranslating = false;
    return;
  }

  const translationsPath = window.THEME_PATH + '/locales/' + lang + '.json';

  fetch(translationsPath)
    .then(response => response.json())
    .then(translations => {
      translationsCache[lang] = translations;
      applyAllTranslations(translations, lang);
      isTranslating = false;
    })
    .catch(err => {
      console.error('Erro ao carregar traduções WooCommerce:', err);
      isTranslating = false;
    });
}

function applyAllTranslations(t, lang) {
  
  // ========== 1. ESTOQUE ==========
  document.querySelectorAll('.stock, p.stock, .availability').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const text = el.textContent.trim();
    const num = text.match(/\d+/);
    if (num) {
      el.textContent = num[0] + ' ' + t.woo_in_stock;
    } else if (text.match(/out|agotado|esgotado|nicht/i)) {
      el.textContent = t.woo_out_of_stock;
    }
    el.dataset.wooLang = lang;
  });

  // ========== 2. BOTÕES ADD TO CART ==========
  document.querySelectorAll('.single_add_to_cart_button, .add_to_cart_button, button[name="add-to-cart"], .cart button[type="submit"]').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const text = el.textContent.toLowerCase();
    if (text.includes('add') || text.includes('adicionar') || text.includes('añadir') || text.includes('hinzufügen') || text.includes('ajouter')) {
      el.textContent = t.woo_add_to_cart;
      el.dataset.wooLang = lang;
    }
  });

  // ========== 3. SKU ==========
  document.querySelectorAll('.product_meta .sku_wrapper, .sku_wrapper, .product-sku').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const sku = el.querySelector('.sku');
    if (sku) {
      const skuValue = sku.textContent;
      el.innerHTML = '<strong>' + t.product_sku + '</strong> <span class="sku">' + skuValue + '</span>';
      el.dataset.wooLang = lang;
    }
  });

  // ========== 4. CATEGORY ==========
  document.querySelectorAll('.product_meta .posted_in, .product-categories').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const links = el.querySelectorAll('a');
    if (links.length > 0) {
      let html = '<strong>' + t.product_category + '</strong> ';
      links.forEach((link, i) => {
        html += link.outerHTML;
        if (i < links.length - 1) html += ', ';
      });
      el.innerHTML = html;
      el.dataset.wooLang = lang;
    }
  });

  // ========== 5. REVIEWS TITLE ==========
  document.querySelectorAll('.woocommerce-Reviews-title, #reviews h2, .reviews-title, h2.woocommerce-Reviews-title').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const reviewCount = el.textContent.match(/\d+/);
    if (reviewCount) {
      el.textContent = t.woo_reviews + ' (' + reviewCount[0] + ')';
    } else {
      el.textContent = t.woo_reviews;
    }
    el.dataset.wooLang = lang;
  });

  // ========== 6. NO REVIEWS YET ==========
  document.querySelectorAll('.woocommerce-noreviews, p.woocommerce-noreviews, .no-reviews').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.textContent = t.woo_no_reviews;
    el.dataset.wooLang = lang;
  });

  // ========== 7. BE THE FIRST TO REVIEW ==========
  document.querySelectorAll('.comment-reply-title, #reply-title, .review-form-title').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const productTitle = document.querySelector('.product_title')?.textContent || '';
    if (productTitle) {
      el.textContent = t.woo_be_first_review + ' "' + productTitle + '"';
    } else {
      el.textContent = t.woo_be_first_review;
    }
    el.dataset.wooLang = lang;
  });

  // ========== 8. RELATED PRODUCTS ==========
  document.querySelectorAll('.related.products > h2, .upsells.products > h2, .related-products > h2, h2.related-title').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.textContent = t.woo_related_products;
    el.dataset.wooLang = lang;
  });

  // ========== 9. TABS (Description, Additional Info, Reviews) ==========
  document.querySelectorAll('.woocommerce-tabs .tabs li a, .wc-tabs li a, .product-tabs a').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const href = el.getAttribute('href') || '';
    const text = el.textContent.toLowerCase().trim();
    
    if (href.includes('description') || text.includes('description') || text.includes('descrição') || text.includes('beschreibung')) {
      el.textContent = t.woo_description || 'Description';
      el.dataset.wooLang = lang;
    }
    else if (href.includes('additional') || text.includes('additional') || text.includes('adicional') || text.includes('zusätzlich')) {
      el.textContent = t.woo_additional_info || 'Additional Information';
      el.dataset.wooLang = lang;
    }
    else if (href.includes('review') || text.includes('review') || text.includes('avalia') || text.includes('bewertung')) {
      el.textContent = t.woo_reviews;
      el.dataset.wooLang = lang;
    }
  });

  // ========== 10. PRICE LABELS (Original/Current) ==========
  document.querySelectorAll('.price').forEach(priceEl => {
    if (priceEl.dataset.wooLang === lang) return;
    
    const del = priceEl.querySelector('del');
    const ins = priceEl.querySelector('ins');
    
    if (del && ins) {
      // Remove labels antigos
      priceEl.querySelectorAll('.price-label-original, .price-label-current').forEach(label => label.remove());
      
      // Adiciona novos
      const labelOrig = document.createElement('span');
      labelOrig.className = 'price-label-original';
      labelOrig.textContent = t.woo_original_price + ' ';
      labelOrig.style.cssText = 'font-size: 0.75em; color: #999; margin-right: 5px; text-decoration: line-through;';
      del.insertBefore(labelOrig, del.firstChild);
      
      const labelCurr = document.createElement('span');
      labelCurr.className = 'price-label-current';
      labelCurr.textContent = t.woo_current_price + ' ';
      labelCurr.style.cssText = 'font-size: 0.8em; color: #53d68a; margin-right: 5px; font-weight: 700;';
      ins.insertBefore(labelCurr, ins.firstChild);
      
      priceEl.dataset.wooLang = lang;
    }
  });

  // ========== 11. QUANTITY LABEL ==========
  document.querySelectorAll('.quantity label, label[for="quantity"], .qty-label').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.textContent = t.woo_quantity;
    el.dataset.wooLang = lang;
  });

  // ========== 12. SALE BADGE ==========
  document.querySelectorAll('.onsale, .sale-badge').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.textContent = t.badge_sale || 'SALE';
    el.dataset.wooLang = lang;
  });

  // ========== 13. FORM LABELS (Review Form) ==========
  document.querySelectorAll('label[for="rating"]').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.childNodes[0].textContent = t.woo_your_rating + ' ';
    el.dataset.wooLang = lang;
  });

  document.querySelectorAll('label[for="comment"]').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.childNodes[0].textContent = t.woo_your_review + ' ';
    el.dataset.wooLang = lang;
  });

  document.querySelectorAll('label[for="author"]').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.childNodes[0].textContent = t.woo_name + ' ';
    el.dataset.wooLang = lang;
  });

  document.querySelectorAll('label[for="email"]').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.childNodes[0].textContent = t.woo_email + ' ';
    el.dataset.wooLang = lang;
  });

  // ========== 14. CHECKBOX SAVE DATA ==========
  document.querySelectorAll('.comment-form-cookies-consent label').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const checkbox = el.querySelector('input[type="checkbox"]');
    if (checkbox) {
      el.innerHTML = '';
      el.appendChild(checkbox);
      el.appendChild(document.createTextNode(' ' + t.woo_save_data));
      el.dataset.wooLang = lang;
    }
  });

  // ========== 15. SUBMIT BUTTON ==========
  document.querySelectorAll('#submit, button[name="submit"]').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    if (el.closest('#respond, .comment-form, #review_form')) {
      el.textContent = t.woo_submit || 'Submit';
      el.dataset.wooLang = lang;
    }
  });

  // ========== 16. AWAITING PRODUCT IMAGE ==========
  document.querySelectorAll('.woocommerce-product-gallery__image--placeholder img').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    el.alt = t.woo_awaiting_image || 'Awaiting product image';
    el.dataset.wooLang = lang;
  });

  // ========== 17. UNCATEGORIZED ==========
  document.querySelectorAll('.posted_in a, .product_cat-uncategorized .woocommerce-loop-product__title + a').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    if (el.textContent.toLowerCase().includes('uncategorized') || el.textContent.toLowerCase().includes('sem categoria')) {
      el.textContent = t.woo_uncategorized || 'Uncategorized';
      el.dataset.wooLang = lang;
    }
  });

  // ========== 18. RATING PLACEHOLDER ==========
  document.querySelectorAll('.comment-form-rating p').forEach(el => {
    if (el.dataset.wooLang === lang) return;
    const select = el.querySelector('select');
    if (select) {
      const firstOption = select.querySelector('option[value=""]');
      if (firstOption) {
        firstOption.textContent = t.woo_rate || 'Rate…';
      }
    }
    el.dataset.wooLang = lang;
  });

  // ========== 19. TEXTOS DIVERSOS (fallback genérico) ==========
  // Pega qualquer texto que contenha palavras em inglês/português/etc
  const textPatterns = {
    'in stock': t.woo_in_stock,
    'out of stock': t.woo_out_of_stock,
    'add to cart': t.woo_add_to_cart,
    'reviews': t.woo_reviews,
    'your rating': t.woo_your_rating,
    'your review': t.woo_your_review,
    'submit': t.woo_submit,
    'name': t.woo_name,
    'email': t.woo_email,
    'description': t.woo_description,
    'additional information': t.woo_additional_info,
    'uncategorized': t.woo_uncategorized,
    'related products': t.woo_related_products,
    'awaiting product image': t.woo_awaiting_image
  };

  // Varre todos os elementos de texto
  document.querySelectorAll('p, span, div, label, button, a, h2, h3').forEach(el => {
    if (el.dataset.wooLang === lang || el.querySelector('*')) return; // Skip se já traduzido ou tem filhos
    
    const text = el.textContent.toLowerCase().trim();
    for (const [pattern, translation] of Object.entries(textPatterns)) {
      if (text === pattern.toLowerCase()) {
        el.textContent = translation;
        el.dataset.wooLang = lang;
        break;
      }
    }
  });

  console.log('✅ WooCommerce traduzido para: ' + lang.toUpperCase());
}

// Executa tradução quando a página carrega
document.addEventListener('DOMContentLoaded', function() {
  console.log('🌐 WooCommerce Translate: DOM pronto, aguardando 500ms...');
  setTimeout(translateWooCommerce, 500);
});

// Re-executa quando o idioma é alterado
window.addEventListener('languageChanged', function() {
  console.log('🔄 Idioma alterado, re-traduzindo WooCommerce...');
  document.querySelectorAll('[data-woo-lang]').forEach(el => {
    el.removeAttribute('data-woo-lang');
  });
  setTimeout(translateWooCommerce, 100);
});

// Tradução inicial adicional (backup)
if (document.readyState === 'complete') {
  console.log('📄 Página já carregada, executando tradução imediata');
  setTimeout(translateWooCommerce, 100);
}
