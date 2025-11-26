// menu-mobile.js - Funcionalidade do menu hambúrguer
(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    
    const btn = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav');

    if (!btn || !nav) {
      console.warn('[menu-mobile.js] Botão ou nav não encontrado');
      return;
    }

    // Toggle do menu mobile
    btn.addEventListener('click', () => {
      btn.classList.toggle('open');
      nav.classList.toggle('open');
      
      // Atualiza aria-expanded para acessibilidade
      const isOpen = nav.classList.contains('open');
      btn.setAttribute('aria-expanded', isOpen);
    });

    // Fecha o menu ao clicar em qualquer link
    document.querySelectorAll('.nav a').forEach(link => {
      link.addEventListener('click', () => {
        btn.classList.remove('open');
        nav.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      });
    });

    // Fecha o menu ao pressionar ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && nav.classList.contains('open')) {
        btn.classList.remove('open');
        nav.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      }
    });

  });

})();
