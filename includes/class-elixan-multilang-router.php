<?php
/**
 * Sistema de Roteamento Multilíngue - Elixan Theme
 * 
 * Gerencia URLs por idioma para SEO e integração com Daisycon
 * Trabalha em conjunto com SimpleTranslate para UX fluida
 * 
 * @package Elixan_Theme
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elixan_Multilang_Router {
    
    /**
     * Idiomas suportados
     * 
     * @var array
     */
    private $supported_languages = array( 'de', 'fr', 'it', 'en', 'es' );
    
    /**
     * Idioma padrão (Alemão - Suíça/DACH)
     * 
     * @var string
     */
    private $default_language = 'de';
    
    /**
     * Idioma atual
     * 
     * @var string
     */
    private $current_language;
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'add_rewrite_rules' ) );
        add_filter( 'query_vars', array( $this, 'add_query_vars' ) );
        add_action( 'template_redirect', array( $this, 'handle_language_routing' ) );
        add_filter( 'post_type_link', array( $this, 'translate_permalink' ), 10, 2 );
        add_action( 'wp_head', array( $this, 'add_hreflang_tags' ) );
        add_action( 'wp_footer', array( $this, 'sync_with_simpletranslate' ) );
    }
    
    /**
     * Adicionar regras de rewrite para URLs multilíngue
     * Formato: /{lang}/path/to/page
     */
    public function add_rewrite_rules() {
        foreach ( $this->supported_languages as $lang ) {
            // Produtos: /{lang}/produkt/{slug}
            add_rewrite_rule(
                "^{$lang}/produkt/([^/]+)/?$",
                'index.php?product=$matches[1]&lang=' . $lang,
                'top'
            );
            
            // Categorias: /{lang}/kategorie/{slug}
            add_rewrite_rule(
                "^{$lang}/kategorie/([^/]+)/?$",
                'index.php?product_cat=$matches[1]&lang=' . $lang,
                'top'
            );
            
            // Página Produtos: /{lang}/produtos
            add_rewrite_rule(
                "^{$lang}/produtos/?$",
                'index.php?pagename=produtos&lang=' . $lang,
                'top'
            );
            
            // Páginas: /{lang}/{page-slug}
            add_rewrite_rule(
                "^{$lang}/(.+?)/?$",
                'index.php?pagename=$matches[1]&lang=' . $lang,
                'top'
            );
            
            // Home: /{lang}/
            add_rewrite_rule(
                "^{$lang}/?$",
                'index.php?lang=' . $lang,
                'top'
            );
        }
    }
    
    /**
     * Adicionar query var para idioma
     */
    public function add_query_vars( $vars ) {
        $vars[] = 'lang';
        return $vars;
    }
    
    /**
     * Processar roteamento de idioma
     */
    public function handle_language_routing() {
        // Não processar no admin ou AJAX
        if ( is_admin() || wp_doing_ajax() ) {
            return;
        }
        
        $current_lang = get_query_var( 'lang' );
        
        // Se não há idioma na URL, detectar e redirecionar
        if ( empty( $current_lang ) ) {
            $detected_lang = $this->detect_language();
            $current_url = $_SERVER['REQUEST_URI'];
            
            // Evitar loop de redirecionamento
            if ( strpos( $current_url, '/' . $detected_lang . '/' ) !== 0 && $current_url !== '/' . $detected_lang ) {
                $new_url = home_url( '/' . $detected_lang . $current_url );
                wp_redirect( $new_url, 302 );
                exit;
            }
        }
        
        // Se há idioma na URL, salvar no cookie
        if ( ! empty( $current_lang ) && in_array( $current_lang, $this->supported_languages ) ) {
            $this->current_language = $current_lang;
            
            // Cookie por 1 ano
            setcookie( 'elixan_lang', $current_lang, time() + YEAR_IN_SECONDS, '/', '', is_ssl(), true );
            
            // Salvar também em localStorage via JavaScript
            add_action( 'wp_footer', function() use ( $current_lang ) {
                echo "<script>localStorage.setItem('idioma', '{$current_lang}'); localStorage.setItem('selectedLanguage', '{$current_lang}');</script>";
            }, 5 );
        }
    }
    
    /**
     * Detectar idioma do usuário
     * Prioridades: 1) Cookie 2) GET param 3) Accept-Language 4) IP 5) Padrão
     * 
     * @return string
     */
    private function detect_language() {
        // 1. Cookie (preferência salva)
        if ( isset( $_COOKIE['elixan_lang'] ) && in_array( $_COOKIE['elixan_lang'], $this->supported_languages ) ) {
            return sanitize_text_field( $_COOKIE['elixan_lang'] );
        }
        
        // 2. Parâmetro GET (link direto/afiliado)
        if ( isset( $_GET['lang'] ) && in_array( $_GET['lang'], $this->supported_languages ) ) {
            return sanitize_text_field( $_GET['lang'] );
        }
        
        // 3. Accept-Language header do navegador
        if ( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ) {
            $browser_langs = explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] );
            foreach ( $browser_langs as $lang ) {
                $lang_code = strtolower( substr( trim( $lang ), 0, 2 ) );
                if ( in_array( $lang_code, $this->supported_languages ) ) {
                    return $lang_code;
                }
            }
        }
        
        // 4. IP Geolocation (opcional - apenas se disponível)
        $country = $this->detect_country_by_ip();
        if ( $country ) {
            $country_lang_map = array(
                'DE' => 'de',  // Alemanha
                'AT' => 'de',  // Áustria
                'CH' => 'de',  // Suíça
                'LI' => 'de',  // Liechtenstein
                'FR' => 'fr',  // França
                'BE' => 'fr',  // Bélgica
                'LU' => 'fr',  // Luxemburgo
                'MC' => 'fr',  // Mônaco
                'IT' => 'it',  // Itália
                'ES' => 'es',  // Espanha
                'GB' => 'en',  // Reino Unido
                'US' => 'en',  // EUA
                'IE' => 'en',  // Irlanda
            );
            
            if ( isset( $country_lang_map[ $country ] ) ) {
                return $country_lang_map[ $country ];
            }
        }
        
        // 5. Fallback: Alemão (mercado principal)
        return $this->default_language;
    }
    
    /**
     * Detectar país por IP usando API gratuita
     * 
     * @return string|false
     */
    private function detect_country_by_ip() {
        $ip = $_SERVER['REMOTE_ADDR'];
        
        // Não processar IPs locais
        if ( $ip === '127.0.0.1' || $ip === '::1' ) {
            return false;
        }
        
        // Cache para não fazer requisição toda hora
        $cached = get_transient( 'elixan_country_' . md5( $ip ) );
        if ( $cached ) {
            return $cached;
        }
        
        // API gratuita: ip-api.com (45 req/min)
        $response = wp_remote_get( "http://ip-api.com/json/{$ip}?fields=countryCode", array(
            'timeout' => 2,
        ) );
        
        if ( is_wp_error( $response ) ) {
            return false;
        }
        
        $body = json_decode( wp_remote_retrieve_body( $response ), true );
        $country = isset( $body['countryCode'] ) ? $body['countryCode'] : false;
        
        if ( $country ) {
            // Cache por 24 horas
            set_transient( 'elixan_country_' . md5( $ip ), $country, DAY_IN_SECONDS );
        }
        
        return $country;
    }
    
    /**
     * Traduzir permalink do produto
     * 
     * @param string $permalink
     * @param WP_Post $post
     * @return string
     */
    public function translate_permalink( $permalink, $post ) {
        if ( $post->post_type !== 'product' ) {
            return $permalink;
        }
        
        $lang = $this->get_current_language();
        
        // Obter slug traduzido
        $translated_slug = get_post_meta( $post->ID, '_slug_' . $lang, true );
        
        if ( empty( $translated_slug ) ) {
            $translated_slug = $post->post_name;
        }
        
        // Construir URL: /{lang}/produkt/{slug}
        return home_url( '/' . $lang . '/produkt/' . $translated_slug );
    }
    
    /**
     * Obter idioma atual
     * 
     * @return string
     */
    public function get_current_language() {
        if ( ! empty( $this->current_language ) ) {
            return $this->current_language;
        }
        
        $lang = get_query_var( 'lang' );
        
        if ( empty( $lang ) ) {
            $lang = $this->detect_language();
        }
        
        return $lang;
    }
    
    /**
     * Adicionar tags hreflang para SEO
     */
    public function add_hreflang_tags() {
        global $post;
        
        if ( ! is_singular() && ! is_front_page() ) {
            return;
        }
        
        foreach ( $this->supported_languages as $lang ) {
            $translated_url = $this->get_translated_url( $post, $lang );
            echo '<link rel="alternate" hreflang="' . esc_attr( $lang ) . '" href="' . esc_url( $translated_url ) . '" />' . "\n";
        }
        
        // x-default (fallback)
        $default_url = $this->get_translated_url( $post, $this->default_language );
        echo '<link rel="alternate" hreflang="x-default" href="' . esc_url( $default_url ) . '" />' . "\n";
    }
    
    /**
     * Obter URL traduzida
     * 
     * @param WP_Post $post
     * @param string $lang
     * @return string
     */
    private function get_translated_url( $post, $lang ) {
        if ( is_front_page() ) {
            return home_url( '/' . $lang . '/' );
        }
        
        if ( ! $post ) {
            return home_url( '/' . $lang . '/' );
        }
        
        if ( $post->post_type === 'product' ) {
            $slug = get_post_meta( $post->ID, '_slug_' . $lang, true );
            
            if ( empty( $slug ) ) {
                $slug = $post->post_name;
            }
            
            return home_url( '/' . $lang . '/produkt/' . $slug );
        }
        
        // Páginas normais
        return home_url( '/' . $lang . '/' . $post->post_name );
    }
    
    /**
     * Sincronizar com SimpleTranslate
     * Garante que o JS e o PHP estão no mesmo idioma
     */
    public function sync_with_simpletranslate() {
        $lang = $this->get_current_language();
        ?>
        <script>
        // Sincronizar idioma com SimpleTranslate
        (function() {
            var phpLang = '<?php echo esc_js( $lang ); ?>';
            
            // Atualizar localStorage
            localStorage.setItem('idioma', phpLang);
            localStorage.setItem('selectedLanguage', phpLang);
            
            // Se SimpleTranslate já carregou, forçar mudança
            if (window.changeLanguage) {
                window.changeLanguage(phpLang).catch(function() {
                    // Silenciar erro se já está no idioma correto
                });
            }
        })();
        </script>
        <?php
    }
    
    /**
     * Gerar Product Feed para Daisycon (por idioma)
     * 
     * @param string $lang
     * @return array
     */
    public function generate_product_feed( $lang = 'de' ) {
        if ( ! in_array( $lang, $this->supported_languages ) ) {
            $lang = $this->default_language;
        }
        
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );
        
        $products = get_posts( $args );
        $feed = array();
        
        foreach ( $products as $product_post ) {
            $product = wc_get_product( $product_post->ID );
            
            if ( ! $product ) {
                continue;
            }
            
            // Obter traduções
            $title = get_post_meta( $product->get_id(), '_title_' . $lang, true );
            $description = get_post_meta( $product->get_id(), '_description_' . $lang, true );
            $short_desc = get_post_meta( $product->get_id(), '_short_desc_' . $lang, true );
            $slug = get_post_meta( $product->get_id(), '_slug_' . $lang, true );
            
            // Fallback para título original
            if ( empty( $title ) ) {
                $title = $product->get_name();
            }
            if ( empty( $description ) ) {
                $description = $product->get_description();
            }
            if ( empty( $short_desc ) ) {
                $short_desc = $product->get_short_description();
            }
            if ( empty( $slug ) ) {
                $slug = $product_post->post_name;
            }
            
            // Categorias
            $categories = wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'names' ) );
            
            $feed[] = array(
                'id' => $product->get_id(),
                'sku' => $product->get_sku(),
                'title' => $title,
                'description' => wp_strip_all_tags( $description ),
                'short_description' => wp_strip_all_tags( $short_desc ),
                'price' => $product->get_price(),
                'regular_price' => $product->get_regular_price(),
                'sale_price' => $product->get_sale_price(),
                'currency' => get_woocommerce_currency(),
                'url' => home_url( '/' . $lang . '/produkt/' . $slug ),
                'image_url' => wp_get_attachment_url( $product->get_image_id() ),
                'in_stock' => $product->is_in_stock() ? 'yes' : 'no',
                'stock_quantity' => $product->get_stock_quantity(),
                'categories' => implode( ', ', $categories ),
                'language' => $lang,
            );
        }
        
        return $feed;
    }
}

// Instanciar classe
function elixan_multilang_router() {
    return new Elixan_Multilang_Router();
}

// Inicializar
elixan_multilang_router();
