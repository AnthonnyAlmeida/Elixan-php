// accordion.js - Sistema de acordeão para página Sobre
(function() {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    
    // Função auxiliar: aguarda i18next estar pronto
    async function getTranslation(key, attempts = 8, delay = 120) {
      for (let i = 0; i < attempts; i++) {
        if (window.i18next && typeof window.i18next.t === "function") {
          const text = window.i18next.t(key);
          if (text && text !== key) return text;
        }
        await new Promise(res => setTimeout(res, delay));
      }
      return key;
    }

    // Função global disponibilizada para o HTML
    window.toggleAccordion = async function (id) {
      const section = document.getElementById(id);
      if (!section) return;

      const defaultContent = document.querySelector('.about-full');
      const contentEl = section.querySelector('.accordion-content');
      const isOpen = section.classList.contains('show');    

      if (isOpen) {
        // FECHAR IDENTIDADE
        section.classList.remove('show');
        section.classList.remove('fade-slide');
        section.style.display = 'none';

        // voltar conteúdo padrão
        defaultContent.style.display = 'block';
        defaultContent.classList.add('show');
        defaultContent.classList.add('fade-slide');

      } else {
        // ABRIR IDENTIDADE
        defaultContent.classList.remove('show');
        defaultContent.style.display = 'none';

        // carregar tradução se ainda não carregou
        if (contentEl && !contentEl.textContent.trim()) {
          const key = contentEl.getAttribute('data-key');
          const translation = await getTranslation(key);
          contentEl.textContent = translation ?? key;
        }

        // mostrar seção Identity
        section.style.display = 'block';

        // animação
        requestAnimationFrame(() => {
          section.classList.add('fade-slide');
          section.classList.add('show');
        });

        // ajustar altura do acordeão
        const h = contentEl.scrollHeight;
        contentEl.style.maxHeight = h + "px";

        // rolar para o topo da seção
        section.scrollIntoView({ behavior: "smooth", block: "start" });
      }
    };

    // Recalcular altura quando redimensionar janela
    window.addEventListener("resize", () => {
      document.querySelectorAll(".accordion-content").forEach(content => {
        if (content.parentElement.parentElement.classList.contains("show")) {
          content.style.maxHeight = content.scrollHeight + "px";
        }
      });
    });

  });

})();
