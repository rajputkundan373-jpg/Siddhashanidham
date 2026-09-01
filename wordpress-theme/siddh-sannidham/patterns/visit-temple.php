<?php
/**
 * Title: Visit Temple
 * Slug: siddh-sannidham/visit-temple
 * Categories: siddh-sannidham
 */
$maps_url = siddh_get_option( 'maps_url', 'https://maps.google.com/?q=Etawa+Gwalior+Road+Madhya+Pradesh' );
$whatsapp = preg_replace( '/\D/', '', siddh_get_option( 'whatsapp', '' ) );
$info = array(
  array( 'hi' => 'निकटतम हवाई अड्डा', 'en' => 'Nearest Airport', 'd_hi' => siddh_get_option( 'nearest_airport_hi', 'ग्वालियर (GWL)' ), 'd_en' => siddh_get_option( 'nearest_airport_en', 'Gwalior (GWL)' ) ),
  array( 'hi' => 'रेलवे स्टेशन',    'en' => 'Railway Station',  'd_hi' => siddh_get_option( 'nearest_rail_hi', 'इटावा एवं ग्वालियर' ), 'd_en' => siddh_get_option( 'nearest_rail_en', 'Etawah & Gwalior' ) ),
  array( 'hi' => 'बस स्टैंड',       'en' => 'Bus Stand',        'd_hi' => siddh_get_option( 'nearest_bus_hi', 'स्थानीय एवं राज्य परिवहन' ), 'd_en' => siddh_get_option( 'nearest_bus_en', 'Local & state transport' ) ),
  array( 'hi' => 'सड़क',             'en' => 'Road',             'd_hi' => siddh_get_option( 'road_hi', 'इटावा-ग्वालियर राजमार्ग' ), 'd_en' => siddh_get_option( 'road_en', 'Etawa–Gwalior highway' ) ),
);
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container ss-grid-2">
    <div>
      <div class="ss-section-eyebrow">VISIT</div>
      <h2 class="hi">यात्रा योजना</h2>
      <div class="gold-underline" style="margin:16px 0 32px"></div>
      <div style="display:flex;flex-direction:column;gap:16px">
        <?php foreach ( $info as $i ) : ?>
          <div class="card-sacred" style="display:flex;gap:16px">
            <div>
              <div class="text-gold" style="font-size:14px"><span data-hi="<?php echo esc_attr( $i['hi'] ); ?>" data-en="<?php echo esc_attr( $i['en'] ); ?>"><?php echo esc_html( $i['hi'] ); ?></span></div>
              <div class="text-ivory" style="margin-top:4px"><span data-hi="<?php echo esc_attr( $i['d_hi'] ); ?>" data-en="<?php echo esc_attr( $i['d_en'] ); ?>"><?php echo esc_html( $i['d_hi'] ); ?></span></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="card-sacred">
      <div style="aspect-ratio:4/3;border:1px solid rgba(212,175,55,.22);border-radius:8px;overflow:hidden">
        <iframe title="Location Map" style="width:100%;height:100%;border:0;filter:grayscale(1) contrast(1.2)" src="https://www.google.com/maps?q=Etawa+Gwalior+Road+Madhya+Pradesh&output=embed"></iframe>
      </div>
      <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:24px">
        <a class="btn-primary-gold" href="<?php echo esc_url( $maps_url ); ?>" target="_blank" rel="noopener"><span data-hi="दिशा-निर्देश" data-en="Directions">दिशा-निर्देश</span></a>
        <?php if ( $whatsapp ) : ?><a class="btn-outline-gold" href="<?php echo esc_url( 'https://wa.me/' . $whatsapp ); ?>" target="_blank" rel="noopener">WhatsApp</a><?php endif; ?>
      </div>
    </div>
  </div>
</section>
<!-- /wp:html -->
