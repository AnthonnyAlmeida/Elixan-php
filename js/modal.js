// js/modal.js  – VERSÃO FINAL SEM FLASH

document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('signup-modal');
  if (!modal) return;

  // Garante que o modal NUNCA aparece antes da hora
  modal.style.display = 'none';

  // Abre o modal
  window.openModal = function () {
    modal.style.display = 'flex';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  };

  // Fecha o modal
  window.closeModal = function () {
    modal.style.display = 'none';
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
  };

  // Fecha clicando fora
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      window.closeModal();
    }
  });

  // Fecha com ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && modal.style.display !== 'none') {
      window.closeModal();
    }
  });
});
