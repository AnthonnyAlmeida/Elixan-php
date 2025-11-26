<?php
/**
 * Script para adicionar produtos Elixan
 * Execute este arquivo uma vez via browser: http://localhost/elixan-wp/wp-content/themes/elixan-theme/add-products.php
 */

require_once('../../../../wp-load.php');

if (!function_exists('wc_get_product')) {
    die('WooCommerce não está ativo!');
}

// Produto 1: Zitrone Öl (Óleo de Limão)
$product_zitrone = new WC_Product_Simple();
$product_zitrone->set_name('Zitrone Öl - Ätherisches Zitronenöl');
$product_zitrone->set_status('publish');
$product_zitrone->set_catalog_visibility('visible');
$product_zitrone->set_description('
<h3>100% Reines Ätherisches Zitronenöl aus der Schweiz</h3>

<p>Unser hochwertiges Zitronenöl wird aus handverlesenen, biologisch angebauten Zitronen gewonnen und nach höchsten Schweizer Qualitätsstandards hergestellt. Das frische, belebende Aroma des Zitronenöls wirkt stimmungsaufhellend und konzentrationsfördernd.</p>

<h4>Wirkung und Anwendung:</h4>
<ul>
<li><strong>Aromatherapie:</strong> 3-5 Tropfen in einen Diffuser geben für eine erfrischende Raumatmosphäre</li>
<li><strong>Massage:</strong> 2-3 Tropfen mit einem Trägeröl (z.B. Mandelöl) vermischen</li>
<li><strong>Luftreinigung:</strong> Natürlicher Raumduft mit antibakterieller Wirkung</li>
<li><strong>Konzentration:</strong> Fördert geistige Klarheit und Fokus</li>
</ul>

<h4>Eigenschaften:</h4>
<ul>
<li>100% naturreines ätherisches Öl</li>
<li>Aus kontrolliert biologischem Anbau</li>
<li>Kaltgepresst zur Erhaltung aller wertvollen Inhaltsstoffe</li>
<li>Frei von Zusatzstoffen und Konservierungsmitteln</li>
<li>Veganes Produkt</li>
<li>Hergestellt in der Schweiz</li>
</ul>

<h4>Hinweise:</h4>
<p>Nicht unverdünnt auf die Haut auftragen. Außerhalb der Reichweite von Kindern aufbewahren. Kühl und dunkel lagern. Nicht während der Schwangerschaft verwenden.</p>
');

$product_zitrone->set_short_description('Erfrischendes 100% reines ätherisches Zitronenöl aus biologischem Anbau. Wirkt stimmungsaufhellend, konzentrationsfördernd und eignet sich perfekt für Aromatherapie und Raumbeduftung. Höchste Schweizer Qualität.');

$product_zitrone->set_regular_price('24.90');
$product_zitrone->set_sale_price('19.90');
$product_zitrone->set_manage_stock(true);
$product_zitrone->set_stock_quantity(50);
$product_zitrone->set_stock_status('instock');
$product_zitrone->set_backorders('no');
$product_zitrone->set_sold_individually(false);
$product_zitrone->set_weight('0.05');
$product_zitrone->set_sku('ELIXAN-ZITRONE-10ML');

$product_id = $product_zitrone->save();

if ($product_id) {
    echo "✅ Produto Zitrone Öl criado com sucesso! ID: $product_id<br>";
    echo "🔗 <a href='http://localhost/elixan-wp/shop/' target='_blank'>Ver na loja</a><br><br>";
} else {
    echo "❌ Erro ao criar produto Zitrone Öl<br>";
}

// Produto 2: Lavendel Öl (Óleo de Lavanda)
$product_lavendel = new WC_Product_Simple();
$product_lavendel->set_name('Lavendel Öl - Ätherisches Lavendelöl');
$product_lavendel->set_status('publish');
$product_lavendel->set_catalog_visibility('visible');
$product_lavendel->set_description('
<h3>100% Reines Ätherisches Lavendelöl aus der Schweiz</h3>

<p>Unser beruhigendes Lavendelöl wird aus den besten Lavendelblüten der Schweizer Alpen gewonnen. Der sanfte, blumige Duft wirkt entspannend und fördert einen erholsamen Schlaf.</p>

<h4>Wirkung und Anwendung:</h4>
<ul>
<li><strong>Schlaffördernd:</strong> 2-3 Tropfen auf das Kopfkissen oder in den Diffuser</li>
<li><strong>Entspannung:</strong> Beruhigt Körper und Geist nach stressigen Tagen</li>
<li><strong>Hautpflege:</strong> Unterstützt die Regeneration bei kleinen Hautirritationen</li>
<li><strong>Meditation:</strong> Schafft eine friedvolle Atmosphäre</li>
</ul>

<h4>Eigenschaften:</h4>
<ul>
<li>100% naturreines ätherisches Öl</li>
<li>Aus Schweizer Alpen-Lavendel</li>
<li>Schonend dampfdestilliert</li>
<li>Frei von synthetischen Duftstoffen</li>
<li>Veganes Produkt</li>
<li>Hergestellt in der Schweiz</li>
</ul>
');

$product_lavendel->set_short_description('Beruhigendes 100% reines ätherisches Lavendelöl aus den Schweizer Alpen. Fördert Entspannung und erholsamen Schlaf. Ideal für Aromatherapie und Hautpflege.');

$product_lavendel->set_regular_price('29.90');
$product_lavendel->set_sale_price('24.90');
$product_lavendel->set_manage_stock(true);
$product_lavendel->set_stock_quantity(35);
$product_lavendel->set_stock_status('instock');
$product_lavendel->set_sku('ELIXAN-LAVENDEL-10ML');

$product_id2 = $product_lavendel->save();

if ($product_id2) {
    echo "✅ Produto Lavendel Öl criado com sucesso! ID: $product_id2<br>";
} else {
    echo "❌ Erro ao criar produto Lavendel Öl<br>";
}

// Produto 3: Pfefferminz Öl (Óleo de Hortelã-Pimenta)
$product_pfefferminz = new WC_Product_Simple();
$product_pfefferminz->set_name('Pfefferminz Öl - Ätherisches Pfefferminzöl');
$product_pfefferminz->set_status('publish');
$product_pfefferminz->set_description('
<h3>100% Reines Ätherisches Pfefferminzöl aus der Schweiz</h3>

<p>Unser erfrischendes Pfefferminzöl mit intensivem Mentholduft wirkt belebend und kühlend. Ideal zur Unterstützung der Konzentration und bei Kopfschmerzen.</p>

<h4>Wirkung und Anwendung:</h4>
<ul>
<li><strong>Kopfschmerzen:</strong> Verdünnt auf die Schläfen auftragen</li>
<li><strong>Konzentration:</strong> Belebt und fördert geistige Wachheit</li>
<li><strong>Atemwege:</strong> Befreiend bei verstopfter Nase</li>
<li><strong>Muskelentspannung:</strong> Kühlend und entspannend</li>
</ul>
');

$product_pfefferminz->set_short_description('Erfrischendes 100% reines ätherisches Pfefferminzöl. Wirkt belebend, konzentrationsfördernd und kühlend. Ideal bei Kopfschmerzen und für freie Atemwege.');

$product_pfefferminz->set_regular_price('22.90');
$product_pfefferminz->set_manage_stock(true);
$product_pfefferminz->set_stock_quantity(40);
$product_pfefferminz->set_stock_status('instock');
$product_pfefferminz->set_sku('ELIXAN-PFEFFERMINZ-10ML');

$product_id3 = $product_pfefferminz->save();

if ($product_id3) {
    echo "✅ Produto Pfefferminz Öl criado com sucesso! ID: $product_id3<br><br>";
} else {
    echo "❌ Erro ao criar produto Pfefferminz Öl<br>";
}

echo "<h2>🎉 Todos os produtos foram criados com sucesso!</h2>";
echo "<p><strong>IMPORTANTE:</strong> Delete este arquivo após a execução por segurança:</p>";
echo "<code>sudo rm " . __FILE__ . "</code>";
