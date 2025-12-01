/**
 * Language Selector - Flag Display Toggle
 * Mostra apenas bandeira quando fechado, texto completo quando aberto
 */

(function() {
  const selector = document.getElementById('languageSelect');
  if (!selector) return;

  // Armazena os textos completos
  const fullTexts = {};
  Array.from(selector.options).forEach(option => {
    const country = option.getAttribute('data-country');
    if (country) {
      fullTexts[option.value] = country;
      // Inicialmente mostra só bandeira
      option.textContent = country.split(' ')[0]; // Pega só o emoji
    }
  });

  // Quando abre o dropdown (focus), mostra texto completo
  selector.addEventListener('focus', () => {
    Array.from(selector.options).forEach(option => {
      const fullText = fullTexts[option.value];
      if (fullText) {
        option.textContent = fullText;
      }
    });
  });

  // Quando fecha o dropdown (blur), volta a mostrar só bandeira
  selector.addEventListener('blur', () => {
    Array.from(selector.options).forEach(option => {
      const fullText = fullTexts[option.value];
      if (fullText) {
        option.textContent = fullText.split(' ')[0]; // Só emoji
      }
    });
  });

  // Quando seleciona, também volta para bandeira
  selector.addEventListener('change', () => {
    setTimeout(() => {
      Array.from(selector.options).forEach(option => {
        const fullText = fullTexts[option.value];
        if (fullText) {
          option.textContent = fullText.split(' ')[0];
        }
      });
    }, 100);
  });

  // Define bandeira inicial no load
  window.addEventListener('load', () => {
    Array.from(selector.options).forEach(option => {
      const fullText = fullTexts[option.value];
      if (fullText) {
        option.textContent = fullText.split(' ')[0];
      }
    });
  });
})();
