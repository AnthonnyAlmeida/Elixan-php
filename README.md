# Elixan Theme

Tema WordPress personalizado para Elixan Aromatica - Site de óleos essenciais suíços com sistema de afiliados.

**Versão:** 6.0.0  
**Autor:** Elixan Team  
**Licença:** Proprietária

---

## 📁 Estrutura do Projeto

```
elixan-theme/
├── assets/                  # Imagens e recursos estáticos
├── css/
│   ├── main.css            # Arquivo principal de importação
│   ├── woocommerce.css     # Estilos WooCommerce
│   ├── base/               # Reset, variáveis, tipografia
│   ├── layout/             # Header, footer, hero, grid
│   ├── components/         # Botões, cards, modal, accordion
│   ├── pages/              # Home, produtos, sobre, afiliados
│   └── utils/              # Helpers, animations, responsive
├── js/
│   ├── menu-mobile.js      # Menu hambúrguer mobile
│   ├── simple-translate.js # Sistema de tradução
│   ├── modal.js            # Modais
│   └── accordion.js        # Acordeões
├── locales/                # Traduções (25 idiomas)
├── *.php                   # Templates WordPress
└── style.css               # Stylesheet principal
```

---

## 🚀 Funcionalidades

- **Sistema Multilíngue:** 25 idiomas suportados
- **Design Responsivo:** Mobile-first @ 880px breakpoint
- **CSS Modular:** Arquitetura organizada e escalável
- **WooCommerce:** Integração completa para loja online
- **Cache Busting:** Atualização automática de assets

---

## ⚙️ Configuração

### Requisitos
- WordPress 6.0+
- PHP 7.4+
- WooCommerce 8.0+ (opcional)

### Instalação
1. Upload do tema para `/wp-content/themes/`
2. Ative no painel WordPress
3. Configure menus em "Aparência → Menus"

---

## 🎨 Customização

### Cores
Edite `css/base/variables.css`

### Traduções
Adicione chaves em `locales/*.json` e use `data-translate` no HTML

---

## 📦 Sincronização (Desenvolvimento)

```bash
# Copiar para servidor
sudo rsync -av --delete \
  /home/usuario/workspace/elixan-theme/ \
  /var/www/html/site/wp-content/themes/elixan-theme/

# Ajustar permissões
sudo chown -R www-data:www-data /var/www/html/site/wp-content/themes/elixan-theme/

# Recarregar Apache
sudo systemctl reload apache2
```

---

## 📄 Licença

© 2025 Elixan Aromatica. Todos os direitos reservados.
