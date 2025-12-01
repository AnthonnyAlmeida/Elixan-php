// simple-translate.js - Sistema de tradução LEVE e RÁPIDO
(function() {
  'use strict';

  let translations = {};
  let currentLang = 'de';

  // Aplica traduções nos elementos
  function applyTranslations() {
    if (!translations[currentLang]) return;
    
    const data = translations[currentLang];
    
    // Busca elementos com data-key OU data-translate
    const elements = document.querySelectorAll('[data-key], [data-translate]');
    
    elements.forEach(el => {
      const key = el.getAttribute('data-key') || el.getAttribute('data-translate');
      if (data[key]) {
        if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
          el.placeholder = data[key];
        } else {
          el.textContent = data[key];
        }
      }
    });
  }

  // Carrega tradução de forma otimizada
  async function loadTranslation(lang) {
    if (translations[lang]) {
      currentLang = lang;
      applyTranslations();
      return Promise.resolve();
    }

    try {
      const url = `${window.THEME_PATH}/locales/${lang}.json`;
      const response = await fetch(url);
      if (response.ok) {
        translations[lang] = await response.json();
        currentLang = lang;
        applyTranslations();
        localStorage.setItem('idioma', lang);
        return Promise.resolve();
      }
    } catch (error) {
      return Promise.reject(error);
    }
  }

  // Força re-aplicação múltiplas vezes para garantir
  function forceApply() {
    applyTranslations();
    setTimeout(() => applyTranslations(), 100);
    setTimeout(() => applyTranslations(), 300);
    setTimeout(() => applyTranslations(), 500);
    setTimeout(() => applyTranslations(), 1000);
  }

  // Inicialização
  document.addEventListener('DOMContentLoaded', () => {
    const selector = document.getElementById('languageSelect');
    if (!selector) return;

    const savedLang = localStorage.getItem('idioma') || 'de';
    selector.value = savedLang;
    localStorage.setItem('selectedLanguage', savedLang); // Sincroniza para WooCommerce
    
    // Carrega e aplica traduções
    loadTranslation(savedLang).then(() => {
      forceApply();
    }).catch(() => {
      // Tenta carregar novamente após 1 segundo
      setTimeout(() => {
        loadTranslation(savedLang).then(() => forceApply());
      }, 1000);
    });

    selector.addEventListener('change', (e) => {
      const newLang = e.target.value;
      loadTranslation(newLang).then(() => {
        localStorage.setItem('idioma', newLang); // Garante que salva
        localStorage.setItem('selectedLanguage', newLang); // Para WooCommerce
        forceApply();
        
        // Dispara evento para outros scripts (ex: WooCommerce)
        window.dispatchEvent(new Event('languageChanged'));
      });
    });
  });

  // Também aplica quando a página carrega completamente
  window.addEventListener('load', () => {
    const selector = document.getElementById('languageSelect');
    if (selector) {
      const savedLang = localStorage.getItem('idioma') || 'de';
      selector.value = savedLang; // Re-aplica o valor salvo
    }
    
    if (translations[currentLang]) {
      forceApply();
    } else {
      const savedLang = localStorage.getItem('idioma') || 'de';
      loadTranslation(savedLang).then(() => forceApply());
    }
  });

})();
