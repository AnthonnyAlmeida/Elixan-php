<?php
/*
Template Name: Afiliados
*/

// Carregar scripts do formulário de afiliados
wp_enqueue_script('jquery');
wp_enqueue_style('elixan-affiliate-form', plugins_url('elixan-affiliates/assets/css/affiliate-form.css'), [], '1.0.0');
wp_enqueue_script('elixan-affiliate-form-js', plugins_url('elixan-affiliates/assets/js/affiliate-form.js'), ['jquery'], '1.0.0', true);
wp_localize_script('elixan-affiliate-form-js', 'elixanAffiliateAjax', [
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('elixan_affiliate_register')
]);

get_header();
?>

<!-- HERO -->
<section class="main-hero">
  <div class="hero-image-container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/banner_elixan.png" alt="Elixan Affiliate Programm - Verdienen Sie mit uns" class="hero-image" loading="eager" width="1920" height="600" />
    <div class="hero-content">
      <h1 data-key="banner_title">Affiliate Programm</h1>
      <button data-affiliate-modal data-key="banner_btn">Jetzt starten</button>
    </div>
  </div>
</section>

<!-- INTRO -->
<section class="introduction">
  <div class="intro-content">
    <p data-key="affiliate_intro_p1">Willkommen im Elixan Affiliate Programm!</p>
    <p data-key="affiliate_intro_p2">Teilen Sie die Vorteile der Aromatherapie mit anderen.</p>
    <p data-key="affiliate_intro_p3">Verdienen Sie ein nachhaltiges Einkommen.</p>
    <p data-key="affiliate_intro_p4">Werden Sie Teil unserer globalen Community.</p>
  </div>
</section>

<!-- BENEFÍCIOS -->
<section class="benefits">
  <div class="benefit">
    <div class="icon"><i class="fas fa-leaf"></i></div>
    <h2 data-key="affiliate_benefit1_title">100% NATÜRLICH</h2>
    <p data-key="affiliate_benefit1_text">Reine und natürliche ätherische Öle.</p>
  </div>
  <div class="benefit">
    <div class="icon"><i class="fas fa-flag"></i></div>
    <h2 data-key="affiliate_benefit2_title">SCHWEIZER QUALITÄT</h2>
    <p data-key="affiliate_benefit2_text">Mit Schweizer Präzision hergestellt.</p>
  </div>
  <div class="benefit">
    <div class="icon"><i class="fas fa-heart"></i></div>
    <h2 data-key="affiliate_benefit3_title">WOHLBEFINDEN</h2>
    <p data-key="affiliate_benefit3_text">Fördert Gleichgewicht und Vitalität.</p>
  </div>
</section>

<!-- PASSO A PASSO -->
<section class="steps-section">
  <h2 data-key="steps_title">So funktioniert's</h2>
  <div class="steps-container">
    <div class="step-card">
      <div class="step-icon">1</div>
      <h3 data-key="step1_title">Registrieren</h3>
      <p data-key="step1_text">Melden Sie sich kostenlos an.</p>
    </div>
    <div class="step-card">
      <div class="step-icon">2</div>
      <h3 data-key="step2_title">Teilen</h3>
      <p data-key="step2_text">Teilen Sie unsere Produkte mit anderen.</p>
    </div>
    <div class="step-card">
      <div class="step-icon">3</div>
      <h3 data-key="step3_title">Verdienen</h3>
      <p data-key="step3_text">Erhalten Sie Provisionen für jeden Verkauf.</p>
    </div>
  </div>
  <button data-affiliate-modal class="cta-button" data-key="steps_cta_btn">Jetzt starten</button>
</section>

<!-- MODAL DE CADASTRO DE AFILIADO -->
<div id="affiliate-modal" class="affiliate-modal">
  <div class="affiliate-modal-content">
    <button class="affiliate-modal-close" aria-label="Fechar">×</button>
    
    <div class="affiliate-modal-header">
      <h2 data-key="affiliate_modal_title">Cadastro de Afiliado</h2>
      <p data-key="affiliate_modal_subtitle">Preencha o formulário abaixo para se tornar um afiliado Elixan</p>
    </div>
    
    <div id="affiliate-form-message" class="affiliate-form-message"></div>
    
    <form id="affiliate-registration-form">
      <!-- Nome Completo -->
      <div class="affiliate-form-group">
        <label class="affiliate-form-label" for="affiliate-name">
          <span data-key="affiliate_form_name">Nome Completo</span> <span class="required">*</span>
        </label>
        <input 
          type="text" 
          id="affiliate-name" 
          class="affiliate-form-input" 
          placeholder="Seu nome completo"
          data-key-placeholder="affiliate_form_name_placeholder"
          required 
        />
      </div>
      
      <!-- Email e Telefone -->
      <div class="affiliate-form-row">
        <div class="affiliate-form-group">
          <label class="affiliate-form-label" for="affiliate-email">
            <span data-key="affiliate_form_email">Email</span> <span class="required">*</span>
          </label>
          <input 
            type="email" 
            id="affiliate-email" 
            class="affiliate-form-input" 
            placeholder="seu@email.com"
            required 
          />
        </div>
        
        <div class="affiliate-form-group">
          <label class="affiliate-form-label" for="affiliate-phone">
            <span data-key="affiliate_form_phone">Telefone</span>
          </label>
          <input 
            type="tel" 
            id="affiliate-phone" 
            class="affiliate-form-input" 
            placeholder="+41 XX XXX XX XX"
          />
        </div>
      </div>
      
      <!-- País -->
      <div class="affiliate-form-group">
        <label class="affiliate-form-label" for="affiliate-country">
          <span data-key="affiliate_form_country">País</span> <span class="required">*</span>
        </label>
        <select id="affiliate-country" class="affiliate-form-select" required>
          <option value="">Selecione seu país</option>
          <option value="Schweiz">🇨🇭 Schweiz (Suíça)</option>
          <option value="Deutschland">🇩🇪 Deutschland (Alemanha)</option>
          <option value="Österreich">🇦🇹 Österreich (Áustria)</option>
          <option value="Frankreich">🇫🇷 Frankreich (França)</option>
          <option value="Italien">🇮🇹 Italien (Itália)</option>
          <option value="Spanien">🇪🇸 Spanien (Espanha)</option>
          <option value="Portugal">🇵🇹 Portugal</option>
          <option value="Polen">🇵🇱 Polen (Polônia)</option>
          <option value="Tschechien">🇨🇿 Tschechien (República Tcheca)</option>
          <option value="Ungarn">🇭🇺 Ungarn (Hungria)</option>
          <option value="Rumänien">🇷🇴 Rumänien (Romênia)</option>
          <option value="Bulgarien">🇧🇬 Bulgarien (Bulgária)</option>
          <option value="Kroatien">🇭🇷 Kroatien (Croácia)</option>
          <option value="Slowenien">🇸🇮 Slowenien (Eslovênia)</option>
          <option value="Slowakei">🇸🇰 Slowakei (Eslováquia)</option>
          <option value="Griechenland">🇬🇷 Griechenland (Grécia)</option>
          <option value="Estland">🇪🇪 Estland (Estônia)</option>
          <option value="Lettland">🇱🇻 Lettland (Letônia)</option>
          <option value="Litauen">🇱🇹 Litauen (Lituânia)</option>
          <option value="Malta">🇲🇹 Malta</option>
          <option value="Finnland">🇫🇮 Finnland (Finlândia)</option>
          <option value="Schweden">🇸🇪 Schweden (Suécia)</option>
          <option value="Norwegen">🇳🇴 Norwegen (Noruega)</option>
        </select>
      </div>
      
      <!-- Chave PIX -->
      <div class="affiliate-form-group">
        <label class="affiliate-form-label" for="affiliate-pix">
          <span data-key="affiliate_form_pix">Chave PIX</span> <span class="required">*</span>
        </label>
        <input 
          type="text" 
          id="affiliate-pix" 
          class="affiliate-form-input" 
          placeholder="email@example.com, CPF, telefone ou chave aleatória"
          data-key-placeholder="affiliate_form_pix_placeholder"
          required 
        />
        <small style="color: rgba(255,255,255,0.6); font-size: 11px; display: block; margin-top: 4px;" data-key="affiliate_form_pix_help">
          As comissões serão enviadas para esta chave PIX
        </small>
      </div>
      
      <!-- Como nos encontrou -->
      <div class="affiliate-form-group">
        <label class="affiliate-form-label" for="affiliate-how-found">
          <span data-key="affiliate_form_how_found">Como conheceu a Elixan?</span>
        </label>
        <textarea 
          id="affiliate-how-found" 
          class="affiliate-form-textarea" 
          placeholder="Conte-nos como descobriu a Elixan..."
          data-key-placeholder="affiliate_form_how_found_placeholder"
        ></textarea>
      </div>
      
      <!-- Termos e Condições -->
      <div class="affiliate-form-group">
        <div class="affiliate-form-checkbox">
          <input type="checkbox" id="affiliate-terms" required />
          <label for="affiliate-terms">
            <span data-key="affiliate_form_terms">
              Li e concordo com os <a href="/termos-afiliados" target="_blank">Termos e Condições</a> do Programa de Afiliados
            </span> <span class="required">*</span>
          </label>
        </div>
      </div>
      
      <!-- Botão Submit -->
      <button type="submit" class="affiliate-form-submit" data-key="affiliate_form_submit">
        Cadastrar como Afiliado
      </button>
    </form>
  </div>
</div>

<!-- CSS e JS do Formulário de Afiliados -->
<link rel="stylesheet" href="<?php echo plugins_url('elixan-affiliates/assets/css/affiliate-form.css'); ?>?v=<?php echo time(); ?>">

<?php get_footer(); ?>

<!-- jQuery (necessário para o formulário) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- Scripts do Formulário -->
<script>
var elixanAffiliateAjax = {
    ajaxurl: '<?php echo admin_url('admin-ajax.php'); ?>',
    nonce: '<?php echo wp_create_nonce('elixan_affiliate_register'); ?>'
};
</script>
<script src="<?php echo plugins_url('elixan-affiliates/assets/js/affiliate-form.js'); ?>?v=<?php echo time(); ?>"></script>
