<?php
/**
 * Title: Live Darshan
 * Slug: siddh-sannidham/live-darshan
 * Categories: siddh-sannidham
 */
$ld = siddh_live_darshan();
$is_live = ! empty( $ld['is_live'] ) && ! empty( $ld['live_url'] );
$aartis = function_exists( 'siddh_get_todays_aartis' ) ? siddh_get_todays_aartis() : array();
?>
<!-- wp:html -->
<section class="ss-section bg-slate-t" style="border-top:1px solid rgba(212,175,55,.22);border-bottom:1px solid rgba(212,175,55,.22)">
  <div class="ss-container">
    <div style="text-align:center;max-width:640px;margin:0 auto 40px">
      <div class="ss-section-eyebrow" style="display:inline-flex;align-items:center;gap:8px"><?php if ( $is_live ) : ?><span class="live-dot"></span><?php endif; ?>LIVE DARSHAN</div>
      <h2 class="hi">"अब दूरी नहीं, दर्शन का अवसर हर समय"</h2>
      <p class="text-muted-ivory" style="margin-top:16px;font-style:italic;font-family:'Cinzel',serif">No distance too far — Darshan awaits you always</p>
    </div>
    <div style="display:grid;grid-template-columns:1fr;gap:24px" class="ss-live-grid">
      <div class="video-frame">
        <?php if ( $is_live ) : ?>
          <?php $embed = str_replace( 'watch?v=', 'embed/', esc_url( $ld['live_url'] ) ); ?>
          <iframe src="<?php echo esc_url( $embed ); ?>" title="Live Darshan" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          <div class="live-badge"><span class="live-dot"></span>LIVE</div>
        <?php else : ?>
          <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:48px">
            <p class="text-ivory" style="font-size:20px" data-hi="लाइव दर्शन अभी उपलब्ध नहीं है।" data-en="Live Darshan is currently offline.">लाइव दर्शन अभी उपलब्ध नहीं है।</p>
            <?php if ( ! empty( $ld['channel_url'] ) ) : ?>
              <a class="btn-outline-gold" style="margin-top:24px" href="<?php echo esc_url( $ld['channel_url'] ); ?>" target="_blank" rel="noopener"><span data-hi="YouTube पर देखें" data-en="Watch on YouTube">YouTube पर देखें</span></a>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="card-sacred">
        <div class="ss-section-eyebrow" style="margin-bottom:16px" data-hi="आज की आरती" data-en="Today's Aartis">आज की आरती</div>
        <?php if ( ! empty( $aartis ) ) : ?>
          <ul class="aarti-list">
            <?php foreach ( $aartis as $a ) : ?>
              <li>
                <span class="name"><span data-hi="<?php echo esc_attr( $a['name_hi'] ); ?>" data-en="<?php echo esc_attr( $a['name_en'] ); ?>"><?php echo esc_html( $a['name_hi'] ); ?></span></span>
                <span class="time"><?php echo esc_html( $a['time'] ); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else : ?>
          <p class="text-muted-ivory" data-hi="कृपया व्यवस्थापक पैनल में आरती जोड़ें।" data-en="Please add aartis in the admin panel.">कृपया व्यवस्थापक पैनल में आरती जोड़ें।</p>
        <?php endif; ?>
        <a href="<?php echo esc_url( home_url( '/live-aarti' ) ); ?>" style="margin-top:24px;display:inline-flex;color:#D4AF37;font-size:14px"><span data-hi="पूर्ण अनुसूची →" data-en="Full Schedule →">पूर्ण अनुसूची →</span></a>
      </div>
    </div>
  </div>
</section>
<style>@media(min-width:1024px){.ss-live-grid{grid-template-columns:2fr 1fr !important}}</style>
<!-- /wp:html -->
