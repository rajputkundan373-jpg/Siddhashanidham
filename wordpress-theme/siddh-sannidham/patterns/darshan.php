<?php
/**
 * Title: Darshan Guidelines
 * Slug: siddh-sannidham/darshan
 * Categories: siddh-sannidham
 */
$timings = array(
  array( 'hi' => 'प्रातः', 'en' => 'Morning', 'time' => siddh_get_option( 'darshan_morning', '05:00 AM – 12:30 PM' ) ),
  array( 'hi' => 'दोपहर', 'en' => 'Afternoon', 'time' => siddh_get_option( 'darshan_evening', '04:00 PM – 09:30 PM' ) ),
  array( 'hi' => 'शनिवार विशेष', 'en' => 'Saturday Special', 'time' => siddh_get_option( 'darshan_saturday', '04:30 AM – 10:30 PM' ) ),
);
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container">
    <div class="ss-section-eyebrow">DARSHAN</div>
    <h2 class="hi">दर्शन</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div class="ss-grid-3">
      <?php foreach ( $timings as $t ) : ?>
        <div class="card-sacred" style="text-align:center">
          <div class="hi" style="font-family:'Rozha One',serif;font-size:22px;color:#F6F4EE"><span data-hi="<?php echo esc_attr( $t['hi'] ); ?>" data-en="<?php echo esc_attr( $t['en'] ); ?>"><?php echo esc_html( $t['hi'] ); ?></span></div>
          <div class="text-gold" style="font-family:'Cinzel',serif;margin-top:12px"><?php echo esc_html( $t['time'] ); ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /wp:html -->
