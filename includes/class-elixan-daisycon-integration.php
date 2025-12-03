<?php
/**
 * Integração com Daisycon - Elixan Theme
 * 
 * Gera product feeds por idioma para rede de afiliados Daisycon
 * Endpoints: /feed/daisycon/{lang}
 * 
 * @package Elixan_Theme
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Elixan_Daisycon_Integration {
    
    /**
     * Idiomas suportados
     * 
     * @var array
     */
    private $supported_languages = array( 'de', 'fr', 'it', 'en', 'es' );
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'add_feed_endpoints' ) );
        add_action( 'template_redirect', array( $this, 'handle_feed_request' ) );
    }
    
    /**
     * Adicionar endpoints para feeds
     */
    public function add_feed_endpoints() {
        foreach ( $this->supported_languages as $lang ) {
            add_rewrite_rule(
                "^feed/daisycon/{$lang}/?$",
                'index.php?daisycon_feed=' . $lang,
                'top'
            );
        }
        
        // Query var
        add_filter( 'query_vars', function( $vars ) {
            $vars[] = 'daisycon_feed';
            return $vars;
        } );
    }
    
    /**
     * Processar requisição de feed
     */
    public function handle_feed_request() {
        $feed_lang = get_query_var( 'daisycon_feed' );
        
        if ( empty( $feed_lang ) ) {
            return;
        }
        
        if ( ! in_array( $feed_lang, $this->supported_languages ) ) {
            wp_die( 'Invalid language', 'Error', array( 'response' => 400 ) );
        }
        
        // Gerar feed
        $this->generate_xml_feed( $feed_lang );
        exit;
    }
    
    /**
     * Gerar feed XML para Daisycon
     * 
     * @param string $lang
     */
    private function generate_xml_feed( $lang ) {
        // Headers XML
        header( 'Content-Type: application/xml; charset=utf-8' );
        
        // Obter produtos
        $router = elixan_multilang_router();
        $products = $router->generate_product_feed( $lang );
        
        // Começar XML
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<products>' . "\n";
        
        foreach ( $products as $product ) {
            $this->output_product_xml( $product );
        }
        
        echo '</products>';
    }
    
    /**
     * Output XML de um produto
     * 
     * @param array $product
     */
    private function output_product_xml( $product ) {
        echo "\t<product>\n";
        
        // Campos obrigatórios Daisycon
        $this->output_xml_field( 'id', $product['id'] );
        $this->output_xml_field( 'sku', $product['sku'] );
        $this->output_xml_field( 'name', $product['title'] );
        $this->output_xml_field( 'description', $product['description'] );
        $this->output_xml_field( 'short_description', $product['short_description'] );
        $this->output_xml_field( 'price', $product['price'] );
        $this->output_xml_field( 'currency', $product['currency'] );
        $this->output_xml_field( 'url', $product['url'] );
        $this->output_xml_field( 'image_url', $product['image_url'] );
        $this->output_xml_field( 'in_stock', $product['in_stock'] );
        $this->output_xml_field( 'language', $product['language'] );
        
        // Campos opcionais
        if ( ! empty( $product['regular_price'] ) ) {
            $this->output_xml_field( 'regular_price', $product['regular_price'] );
        }
        
        if ( ! empty( $product['sale_price'] ) ) {
            $this->output_xml_field( 'sale_price', $product['sale_price'] );
        }
        
        if ( ! empty( $product['stock_quantity'] ) ) {
            $this->output_xml_field( 'stock_quantity', $product['stock_quantity'] );
        }
        
        if ( ! empty( $product['categories'] ) ) {
            $this->output_xml_field( 'categories', $product['categories'] );
        }
        
        echo "\t</product>\n";
    }
    
    /**
     * Output de campo XML com CDATA
     * 
     * @param string $tag
     * @param mixed $value
     */
    private function output_xml_field( $tag, $value ) {
        if ( empty( $value ) ) {
            return;
        }
        
        // Números e booleanos não precisam de CDATA
        if ( is_numeric( $value ) || in_array( $value, array( 'yes', 'no' ) ) ) {
            echo "\t\t<{$tag}>" . esc_html( $value ) . "</{$tag}>\n";
        } else {
            // Strings com CDATA para evitar problemas de encoding
            echo "\t\t<{$tag}><![CDATA[" . $value . "]]></{$tag}>\n";
        }
    }
    
    /**
     * Limpar cache do feed (útil ao salvar produtos)
     */
    public static function clear_feed_cache() {
        // Se usar cache de feed no futuro
        delete_transient( 'elixan_daisycon_feed_cache' );
    }
}

// Instanciar classe
function elixan_daisycon_integration() {
    return new Elixan_Daisycon_Integration();
}

// Inicializar
elixan_daisycon_integration();

// Limpar cache ao salvar produto
add_action( 'save_post_product', array( 'Elixan_Daisycon_Integration', 'clear_feed_cache' ) );
