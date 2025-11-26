// language.js - Gerenciamento de seleção de idiomas
(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    
    const seletor = document.getElementById('language-selector');
    if (!seletor) {
      return;
    }

    const idiomasDisponiveis = [
      "de", "pt", "en", "fr", "it", "es", "cs", "pl", "sv", "fi",
      "et", "lv", "lt", "sk", "hu", "ro", "bg", "el", "mt", "sl", "hr", "no"
    ];

    const idiomaSalvo = localStorage.getItem('idioma') || 'de';
    const validarIdioma = (idioma) => idiomasDisponiveis.includes(idioma);

    // Aplica o idioma salvo
    if (validarIdioma(idiomaSalvo)) {
      window.carregarTraducoes(idiomaSalvo);
    } else {
      window.carregarTraducoes('en');
    }

    // Seleciona valor no dropdown
    seletor.value = idiomaSalvo;

    seletor.addEventListener('change', (e) => {
      const novoIdioma = e.target.value;
      if (validarIdioma(novoIdioma)) {
        localStorage.setItem('idioma', novoIdioma);
        window.carregarTraducoes(novoIdioma);
      }
    });

  });

})();
