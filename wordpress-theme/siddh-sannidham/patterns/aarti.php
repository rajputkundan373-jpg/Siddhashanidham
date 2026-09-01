<?php
/**
 * Title: Aarti Schedule
 * Slug: siddh-sannidham/aarti
 * Categories: siddh-sannidham
 */
$aartis = function_exists( 'siddh_get_todays_aartis' ) ? siddh_get_todays_aartis() : array();
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container" style="max-width:800px">
    <div class="ss-section-eyebrow" data-hi="अनुसूची" data-en="Schedule">अनुसूची</div>
    <h2 class="hi">आरती एवं पूजा</h2>
    <div class="gold-underline" style="margin:16px 0 32px"></div>
    <div class="card-sacred">
      <ul class="aarti-list">
        <?php foreach ( $aartis as $a ) : ?>
          <li>
            <span class="name" data-hi="<?php echo esc_attr( $a['name_hi'] ); ?>" data-en="<?php echo esc_attr( $a['name_en'] ); ?>"><?php echo esc_html( $a['name_hi'] ); ?></span>
            <span class="time"><?php echo esc_html( $a['time'] ); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<!-- /wp:html -->
