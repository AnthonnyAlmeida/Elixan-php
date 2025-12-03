<?php
/**
 * Meta Boxes de Traduções para Produtos - Elixan Theme
 * 
 * Permite adicionar títulos, slugs e descrições traduzidos para cada produto
 * Suporta: DE, FR, IT, EN, ES (mercado europeu)
 * 
 * @package Elixan_Theme
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elixan_Product_Translations {
    
    /**
     * Idiomas suportados
     * 
     * @var array
     */
    private $supported_languages = array(
        'de' => 'Deutsch (German)',
        'fr' => 'Français (French)',
        'it' => 'Italiano (Italian)',
        'en' => 'English',
        'es' => 'Español (Spanish)',
    );
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_translation_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_translation_meta_boxes' ), 10, 2 );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
    }
    
    /**
     * Adicionar Meta Box de traduções
     */
    public function add_translation_meta_boxes() {
        add_meta_box(
            'elixan_product_translations',
            __( 'Traduções do Produto', 'elixan-theme' ),
            array( $this, 'render_translation_meta_box' ),
            'product',
            'normal',
            'high'
        );
    }
    
    /**
     * Renderizar Meta Box de traduções
     * 
     * @param WP_Post $post
     */
    public function render_translation_meta_box( $post ) {
        // Nonce para segurança
        wp_nonce_field( 'elixan_translations_nonce', 'elixan_translations_nonce_field' );
        
        echo '<div class="elixan-translations-wrapper">';
        echo '<p class="description">' . esc_html__( 'Adicione traduções para melhorar SEO em cada idioma. URLs serão: /{lang}/produkt/{slug}', 'elixan-theme' ) . '</p>';
        
        // Tabs
        echo '<div class="elixan-translation-tabs">';
        
        foreach ( $this->supported_languages as $lang_code => $lang_name ) {
            $active = ( $lang_code === 'de' ) ? 'active' : '';
            echo '<button type="button" class="elixan-tab-button ' . esc_attr( $active ) . '" data-lang="' . esc_attr( $lang_code ) . '">';
            echo esc_html( $lang_name );
            echo '</button>';
        }
        
        echo '</div>';
        
        // Conteúdo das tabs
        echo '<div class="elixan-translation-content">';
        
        foreach ( $this->supported_languages as $lang_code => $lang_name ) {
            $active = ( $lang_code === 'de' ) ? 'active' : '';
            
            echo '<div class="elixan-translation-panel ' . esc_attr( $active ) . '" data-lang="' . esc_attr( $lang_code ) . '">';
            
            $this->render_translation_fields( $post->ID, $lang_code, $lang_name );
            
            echo '</div>';
        }
        
        echo '</div>';
        echo '</div>';
        
        // Script inline para tabs
        ?>
        <script>
        jQuery(document).ready(function($) {
            $('.elixan-tab-button').on('click', function(e) {
                e.preventDefault();
                var lang = $(this).data('lang');
                
                // Remover active de todos
                $('.elixan-tab-button').removeClass('active');
                $('.elixan-translation-panel').removeClass('active');
                
                // Adicionar active ao clicado
                $(this).addClass('active');
                $('.elixan-translation-panel[data-lang="' + lang + '"]').addClass('active');
            });
        });
        </script>
        <?php
    }
    
    /**
     * Renderizar campos de tradução para um idioma
     * 
     * @param int $post_id
     * @param string $lang_code
     * @param string $lang_name
     */
    private function render_translation_fields( $post_id, $lang_code, $lang_name ) {
        // Obter valores salvos
        $title = get_post_meta( $post_id, '_title_' . $lang_code, true );
        $slug = get_post_meta( $post_id, '_slug_' . $lang_code, true );
        $short_desc = get_post_meta( $post_id, '_short_desc_' . $lang_code, true );
        $description = get_post_meta( $post_id, '_description_' . $lang_code, true );
        
        echo '<table class="form-table">';
        
        // Título
        echo '<tr>';
        echo '<th><label for="title_' . esc_attr( $lang_code ) . '">' . esc_html__( 'Título', 'elixan-theme' ) . '</label></th>';
        echo '<td>';
        echo '<input type="text" id="title_' . esc_attr( $lang_code ) . '" name="translation_title[' . esc_attr( $lang_code ) . ']" value="' . esc_attr( $title ) . '" class="large-text" />';
        echo '<p class="description">' . esc_html__( 'Nome do produto em', 'elixan-theme' ) . ' ' . esc_html( $lang_name ) . '</p>';
        echo '</td>';
        echo '</tr>';
        
        // Slug
        echo '<tr>';
        echo '<th><label for="slug_' . esc_attr( $lang_code ) . '">' . esc_html__( 'Slug (URL)', 'elixan-theme' ) . '</label></th>';
        echo '<td>';
        echo '<input type="text" id="slug_' . esc_attr( $lang_code ) . '" name="translation_slug[' . esc_attr( $lang_code ) . ']" value="' . esc_attr( $slug ) . '" class="large-text" />';
        echo '<p class="description">' . sprintf( esc_html__( 'URL final: %s/%s/produkt/%s', 'elixan-theme' ), home_url(), $lang_code, '<strong>' . ( $slug ?: 'seu-slug' ) . '</strong>' ) . '</p>';
        echo '</td>';
        echo '</tr>';
        
        // Descrição Curta
        echo '<tr>';
        echo '<th><label for="short_desc_' . esc_attr( $lang_code ) . '">' . esc_html__( 'Descrição Curta', 'elixan-theme' ) . '</label></th>';
        echo '<td>';
        echo '<textarea id="short_desc_' . esc_attr( $lang_code ) . '" name="translation_short_desc[' . esc_attr( $lang_code ) . ']" rows="4" class="large-text">' . esc_textarea( $short_desc ) . '</textarea>';
        echo '<p class="description">' . esc_html__( 'Resumo que aparece nas listagens e abaixo do título', 'elixan-theme' ) . '</p>';
        echo '</td>';
        echo '</tr>';
        
        // Descrição Completa
        echo '<tr>';
        echo '<th><label for="description_' . esc_attr( $lang_code ) . '">' . esc_html__( 'Descrição Completa', 'elixan-theme' ) . '</label></th>';
        echo '<td>';
        
        // Editor WordPress
        wp_editor( 
            $description, 
            'description_' . $lang_code,
            array(
                'textarea_name' => 'translation_description[' . $lang_code . ']',
                'textarea_rows' => 10,
                'media_buttons' => false,
                'teeny' => true,
                'quicktags' => true,
            )
        );
        
        echo '<p class="description">' . esc_html__( 'Descrição detalhada do produto para SEO e conversão', 'elixan-theme' ) . '</p>';
        echo '</td>';
        echo '</tr>';
        
        echo '</table>';
    }
    
    /**
     * Salvar meta boxes
     * 
     * @param int $post_id
     * @param WP_Post $post
     */
    public function save_translation_meta_boxes( $post_id, $post ) {
        // Verificar autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        
        // Verificar tipo de post
        if ( $post->post_type !== 'product' ) {
            return;
        }
        
        // Verificar nonce
        if ( ! isset( $_POST['elixan_translations_nonce_field'] ) ) {
            return;
        }
        
        if ( ! wp_verify_nonce( $_POST['elixan_translations_nonce_field'], 'elixan_translations_nonce' ) ) {
            return;
        }
        
        // Verificar permissões
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        // Salvar traduções
        $fields = array( 'title', 'slug', 'short_desc', 'description' );
        
        foreach ( $fields as $field ) {
            if ( ! isset( $_POST['translation_' . $field] ) ) {
                continue;
            }
            
            foreach ( $this->supported_languages as $lang_code => $lang_name ) {
                if ( ! isset( $_POST['translation_' . $field][ $lang_code ] ) ) {
                    continue;
                }
                
                $value = $_POST['translation_' . $field][ $lang_code ];
                
                // Sanitização conforme tipo de campo
                switch ( $field ) {
                    case 'title':
                        $value = sanitize_text_field( $value );
                        break;
                        
                    case 'slug':
                        $value = sanitize_title( $value );
                        break;
                        
                    case 'short_desc':
                        $value = sanitize_textarea_field( $value );
                        break;
                        
                    case 'description':
                        $value = wp_kses_post( $value );
                        break;
                }
                
                // Salvar ou deletar se vazio
                if ( ! empty( $value ) ) {
                    update_post_meta( $post_id, '_' . $field . '_' . $lang_code, $value );
                } else {
                    delete_post_meta( $post_id, '_' . $field . '_' . $lang_code );
                }
            }
        }
    }
    
    /**
     * Estilos CSS para admin
     */
    public function enqueue_admin_styles( $hook ) {
        // Apenas na tela de edição de produto
        if ( $hook !== 'post.php' && $hook !== 'post-new.php' ) {
            return;
        }
        
        global $post_type;
        if ( $post_type !== 'product' ) {
            return;
        }
        
        // CSS inline
        wp_add_inline_style( 'wp-admin', '
            .elixan-translations-wrapper {
                margin-top: 10px;
            }
            
            .elixan-translation-tabs {
                display: flex;
                gap: 5px;
                margin-bottom: 20px;
                border-bottom: 1px solid #ccc;
            }
            
            .elixan-tab-button {
                padding: 10px 20px;
                border: 1px solid #ccc;
                border-bottom: none;
                background: #f0f0f0;
                cursor: pointer;
                font-size: 14px;
                font-weight: 500;
                transition: all 0.2s;
            }
            
            .elixan-tab-button:hover {
                background: #e0e0e0;
            }
            
            .elixan-tab-button.active {
                background: #fff;
                border-bottom: 1px solid #fff;
                margin-bottom: -1px;
                color: #0073aa;
            }
            
            .elixan-translation-panel {
                display: none;
                padding: 20px 0;
            }
            
            .elixan-translation-panel.active {
                display: block;
            }
            
            .elixan-translation-panel .form-table th {
                width: 200px;
                padding: 15px 10px 15px 0;
            }
            
            .elixan-translation-panel .form-table td {
                padding: 15px 10px;
            }
        ' );
    }
}

// Instanciar classe
function elixan_product_translations() {
    return new Elixan_Product_Translations();
}

// Inicializar
elixan_product_translations();
