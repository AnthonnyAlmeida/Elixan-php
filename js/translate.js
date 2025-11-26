// translate.js - Sistema de tradução i18next para WordPress
// i18next já está disponível globalmente via <script> no header.php

(function() {
  'use strict';

  // Inicializa i18next
  i18next.init({
    fallbackLng: 'en',
    resources: {}
  });

  // ------------------------------------------
  // Função que aplica traduções nos elementos
  // ------------------------------------------
  function applyTranslations() {
    const lang = i18next.language;

    document.querySelectorAll('[data-key]').forEach((el) => {
      const key = el.getAttribute('data-key');
      if (!key) return;

      const translation = i18next.t(key);

      if (el.tagName === 'IMG') {
        el.alt = translation;
      } else if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') {
        el.placeholder = translation;
      } else {
        el.textContent = translation;
      }

      console.log(`[translate.js] aplicado ${lang}: ${key} -> ${translation}`);
    });
  }

  // --------------------------------------------------
  // Carrega JSON da tradução e aplica no i18next
  // --------------------------------------------------
  window.carregarTraducoes = async function(lang) {
    try {
      // Usando variável global do WordPress
      const url = `${ElixanLocales.path}${lang}.json?v=${Date.now()}`;
      console.log('[translate.js] carregando:', url);

      const response = await fetch(url);
      console.log('[translate.js] status:', response.status);

      if (!response.ok) {
        throw new Error(`Erro ao carregar o arquivo de tradução: ${lang}.json`);
      }

      const data = await response.json();
      console.log('[translate.js] chaves carregadas:', Object.keys(data).length);

      // Atualiza recursos no i18next
      i18next.addResourceBundle(lang, 'translation', data, true, true);
      await i18next.changeLanguage(lang);

      // Aplica traduções após carregar + mudar idioma
      applyTranslations();

    } catch (error) {
      console.error(`[translate.js] erro ao carregar ${lang}:`, error);
    }
  };

  // Expõe função globalmente para outros scripts
  window.applyTranslations = applyTranslations;

})();
