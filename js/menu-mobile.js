// menu-mobile.js - Funcionalidade do menu hambúrguer
(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    
    const btn = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav');

    if (!btn || !nav) {
      return;
    }

    // Toggle do menu mobile
    btn.addEventListener('click', () => {
      btn.classList.toggle('open');
      nav.classList.toggle('active'); // Usa 'active' para o menu
      
      // Atualiza aria-expanded para acessibilidade
      const isOpen = nav.classList.contains('active');
      btn.setAttribute('aria-expanded', isOpen);
      
      // Log para debug
      console.log('Menu toggled:', isOpen ? 'ABERTO' : 'FECHADO');
    });

    // Fecha o menu ao clicar em qualquer link
    document.querySelectorAll('.nav a').forEach(link => {
      link.addEventListener('click', () => {
        btn.classList.remove('open');
        nav.classList.remove('active');
        btn.setAttribute('aria-expanded', 'false');
      });
    });

    // Fecha o menu ao pressionar ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && nav.classList.contains('active')) {
        btn.classList.remove('open');
        nav.classList.remove('active');
        btn.setAttribute('aria-expanded', 'false');
      }
    });

    // Log inicial para confirmar carregamento
    console.log('✅ Menu Mobile JS carregado com sucesso!');

  });

})();
