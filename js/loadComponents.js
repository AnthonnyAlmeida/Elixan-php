// Função principal para carregar qualquer componente
async function loadComponent(id, file) {
    const container = document.getElementById(id);
    if (!container) return;

    try {
        const response = await fetch(`components/${file}`);
        const html = await response.text();
        container.innerHTML = html;

        // Dispara evento personalizado (caso use em outros lugares)
        document.dispatchEvent(new CustomEvent(`componentLoaded:${id}`));

        // Se o header carregar → ativa navbar, menu mobile e destaca link ativo
        if (id === "header") {
            highlightActiveLink();
            ativarMenuMobile();
        }

    } catch (error) {
        console.error(`Erro ao carregar componente ${file}:`, error);
    }
}

// Destaca o link ativo na navbar
function highlightActiveLink() {
    const currentPage = window.location.pathname.split("/").pop() || "index.html";
    const navLinks = document.querySelectorAll(".nav a");

    navLinks.forEach(link => {
        const href = link.getAttribute("href");
        link.classList.toggle("active", href === currentPage);
    });
}

// Menu mobile: botão "hambúrguer" → abre/fecha nav
function ativarMenuMobile() {
    const btn = document.querySelector('.menu-toggle');
    const nav = document.querySelector('.nav');

    if (!btn || !nav) return;

    btn.addEventListener('click', () => {
        btn.classList.toggle('open');
        nav.classList.toggle('open');
    });

    // Fecha o menu ao clicar em qualquer link
    document.querySelectorAll('.nav a').forEach(link => {
        link.addEventListener('click', () => {
            btn.classList.remove('open');
            nav.classList.remove('open');
        });
    });
}

// Carrega header, navbar e footer automaticamente
document.addEventListener("DOMContentLoaded", () => {
    // Header placeholder
    loadComponent("header", "header.html");
    // Footer placeholder
    loadComponent("footer", "footer.html");
});
