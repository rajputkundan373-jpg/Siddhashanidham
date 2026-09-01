<?php
/**
 * Title: Today at Siddh Sannidham
 * Slug: siddh-sannidham/today-at-temple
 * Categories: siddh-sannidham
 */
$today = array(
  array( 'हि' => 'आज की आरती', 'en' => "Today's Aarti", 'val' => siddh_get_option( 'today_aarti', 'संध्या आरती सायं 07:15 बजे' ) ),
  array( 'हि' => 'आज की पूजा', 'en' => "Today's Puja", 'val' => siddh_get_option( 'today_puja', 'शनि तेल अभिषेक सायं 06:00 बजे' ) ),
  array( 'हि' => 'आज का भंडारा', 'en' => "Today's Bhandara", 'val' => siddh_get_option( 'today_bhandara', 'सात्विक भंडारा दोपहर 12:30 बजे' ) ),
  array( 'हि' => 'विशेष आयोजन', 'en' => 'Special Event', 'val' => siddh_get_option( 'today_special', 'संध्या आरती के पश्चात आशीर्वाद समारोह' ) ),
);
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container">
    <div class="ss-section-eyebrow" data-hi="आज का दिन" data-en="Today">आज का दिन</div>
    <h2 class="hi">आज सिद्ध सन्निधम् में</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div class="ss-grid-3">
      <?php foreach ( $today as $t ) : ?>
        <div class="card-sacred">
          <div class="ss-section-eyebrow" style="margin-bottom:12px"><span data-hi="<?php echo esc_attr( $t['हि'] ); ?>" data-en="<?php echo esc_attr( $t['en'] ); ?>"><?php echo esc_html( $t['हि'] ); ?></span></div>
          <div class="text-ivory" style="font-size:18px"><?php echo esc_html( $t['val'] ); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /wp:html -->
