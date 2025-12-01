/**
 * Language Selector - Corporate Premium Style
 * Dropdown customizado com busca e integração com sistema de tradução
 */

(function() {
  const selector = document.getElementById('languageSelector');
  const button = document.getElementById('currentLanguage');
  const dropdown = document.getElementById('languageDropdown');
  const searchInput = document.getElementById('languageSearch');
  const list = document.querySelector('.language-selector__list');
  
  if (!selector || !button || !dropdown || !searchInput || !list) {
    console.warn('Language selector: Elementos não encontrados');
    return;
  }

  let currentLang = localStorage.getItem('idioma') || 'de';

  // Fecha dropdown ao clicar fora
  document.addEventListener('click', (e) => {
    if (!selector.contains(e.target)) {
      selector.classList.remove('open');
    }
  });

  // Toggle dropdown
  button.addEventListener('click', (e) => {
    e.stopPropagation();
    selector.classList.toggle('open');
    if (selector.classList.contains('open')) {
      searchInput.focus();
    }
  });

  // Busca de idiomas
  searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const items = list.querySelectorAll('li');
    
    items.forEach(item => {
      const name = item.getAttribute('data-name').toLowerCase();
      const country = item.querySelector('.name').textContent.toLowerCase();
      
      if (name.includes(searchTerm) || country.includes(searchTerm)) {
        item.classList.remove('hidden');
      } else {
        item.classList.add('hidden');
      }
    });
  });

  // Seleção de idioma
  list.addEventListener('click', (e) => {
    const item = e.target.closest('li');
    if (!item) return;

    const lang = item.getAttribute('data-lang');
    const flag = item.getAttribute('data-flag');
    const name = item.getAttribute('data-name');

    // Atualiza botão
    button.querySelector('.language-selector__flag').textContent = flag;
    button.querySelector('.language-selector__name').textContent = name;

    // Remove active de todos
    list.querySelectorAll('li').forEach(li => li.classList.remove('active'));
    // Adiciona active no selecionado
    item.classList.add('active');

    // Salva no localStorage
    localStorage.setItem('idioma', lang);
    localStorage.setItem('selectedLanguage', lang);

    // Fecha dropdown
    selector.classList.remove('open');

    // Limpa busca
    searchInput.value = '';
    list.querySelectorAll('li').forEach(li => li.classList.remove('hidden'));

    // Carrega traduções (integração com simple-translate.js)
    if (window.loadTranslation) {
      window.loadTranslation(lang).then(() => {
        if (window.forceApply) window.forceApply();
        window.dispatchEvent(new Event('languageChanged'));
        console.log('✅ Idioma alterado para: ' + lang.toUpperCase());
      });
    } else {
      // Fallback: recarrega página
      window.location.reload();
    }
  });

  // Define idioma inicial no carregamento
  function setInitialLanguage() {
    const items = list.querySelectorAll('li');
    items.forEach(item => {
      const lang = item.getAttribute('data-lang');
      if (lang === currentLang) {
        const flag = item.getAttribute('data-flag');
        const name = item.getAttribute('data-name');
        
        button.querySelector('.language-selector__flag').textContent = flag;
        button.querySelector('.language-selector__name').textContent = name;
        item.classList.add('active');
      }
    });
  }

  // Fecha dropdown com ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && selector.classList.contains('open')) {
      selector.classList.remove('open');
    }
  });

  // Inicializa
  setInitialLanguage();

  console.log('✅ Language Selector carregado - Idioma atual: ' + currentLang.toUpperCase());

})();
