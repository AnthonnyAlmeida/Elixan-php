<?php
/*
Template Name: Afiliados
*/
get_header();
?>

<!-- HERO -->
<section class="main-hero">
  <div class="hero-image-container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/banner_elixan.png" alt="Elixan Banner" class="hero-image" />
    <div class="hero-content">
      <h1 data-key="banner_title">Affiliate Programm</h1>
      <button onclick="openModal()" data-key="banner_btn">Jetzt starten</button>
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
  <button onclick="openModal()" class="cta-button" data-key="steps_cta_btn">Jetzt starten</button>
</section>

<!-- MODAL -->
<div id="signup-modal" class="modal hidden" style="display:none;">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">×</span>
    <h2 data-key="modal_title">Anmelden</h2>
    <input type="text" placeholder="Name" data-key="modal_name" />
    <input type="email" placeholder="E-Mail" data-key="modal_email" />
    <button data-key="modal_submit">Absenden</button>
  </div>
</div>

<?php get_footer(); ?>
