<?php
/*
Template Name: Sobre Nós
*/
get_header();
?>

<!-- HERO -->
<section class="main-hero">
  <div class="hero-image-container">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/aboutus.png" alt="Sobre Nós Banner" class="hero-image" />
    <div class="hero-content">
      <h1 data-key="about_banner_title">Über Elixan Aromatica</h1>
    </div>
  </div>
</section>

<!-- NAVEGAÇÃO INTERNA -->
<nav class="internal-nav">
  <button class="internal-nav-btn" data-key="btn_identity" onclick="toggleAccordion('identity')">Identität</button>
  <button class="internal-nav-btn" data-key="btn_structure" onclick="scrollToSection('structure')">Struktur & Produktion</button>
  <button class="internal-nav-btn" data-key="btn_quality" onclick="scrollToSection('quality')">Qualität</button>
  <button class="internal-nav-btn" data-key="btn_experience" onclick="scrollToSection('experience')">Erfahrung</button>
  <button class="internal-nav-btn" data-key="btn_gmp" onclick="scrollToSection('gmp')">GMP-Zertifizierung</button>
  <button class="internal-nav-btn" data-key="btn_market" onclick="scrollToSection('market')">Marktpräsenz</button>
</nav>

<!-- SEÇÃO IDENTIDADE -->
<section id="identity" class="about-section fade-slide" style="display:none;">
  <div class="accordion-section">
    <div class="accordion-content" data-key="about_identity_full"></div>
  </div>
</section>

<!-- SEÇÃO PRINCIPAL -->
<section class="about-full fade-slide show">
  <div class="container">
    <h2 data-key="about_heading_main">🌿 Elixan Aromatica: Natur und Schweizer Präzision</h2>

    <p class="about-lead" data-key="about_intro">
      Elixan wurde im Herzen der Schweiz gegründet – mit dem Ziel, die Reinheit der Natur mit der Präzision schweizerischer Herstellung zu vereinen.
    </p>

    <h3 data-key="about_heading_purity">Reinheit und Qualität seit dem ersten Tag</h3>
    <ul class="about-list">
      <li><span data-key="about_purity_text">Unsere Grundlagen waren von Anfang an klar: echte, unverfälschte ätherische Öle.</span></li>
      <li><span data-key="about_heading_quality">Schweizer Herstellung mit Präzision</span></li>
      <li><span data-key="about_heading_sourcing">Nachhaltige Herkunft & faire Partnerschaften</span></li>
      <li><span data-key="about_heading_innovation">Tradition trifft Innovation</span></li>
    </ul>

    <h3 data-key="about_heading_whatwedo">Was wir anbieten</h3>
    <ul class="about-list">
      <li><span data-key="about_list_item1">100% natürliche ätherische Öle</span></li>
      <li><span data-key="about_list_item2">Aromatische Lösungen für Parfümerie und Kosmetik</span></li>
      <li><span data-key="about_list_item3">Hochreine pharmazeutische Rohstoffe</span></li>
    </ul>

    <p class="about-signature" data-key="about_signature">✨ Elixan Aromatica – Wo Reinheit geboren und mit Schweizer Präzision veredelt wird.</p>
  </div>
</section>

<?php get_footer(); ?>
