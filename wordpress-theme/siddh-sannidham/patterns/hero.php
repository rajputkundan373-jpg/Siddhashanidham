<?php
/**
 * Title: Hero
 * Slug: siddh-sannidham/hero
 * Categories: siddh-sannidham
 */
?>
<!-- wp:html -->
<section class="ss-hero">
  <div class="bg">
    <?php $img = siddh_get_option( 'hero_image_url', 'https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1800&q=90' ); ?>
    <img src="<?php echo esc_url( $img ); ?>" alt="<?php esc_attr_e( 'Sacred aarti flames at Siddh Sannidham', 'siddh-sannidham' ); ?>">
  </div>
  <div class="fade"></div>
  <div class="ss-container ss-hero-content fade-up">
    <div class="mantra">॥ ॐ नीलांजनसमाभासं रविपुत्रं यमाग्रजम् ॥</div>
    <div class="eyebrow">॥ श्री शनिदेवाय नमः ॥</div>
    <h1>SIDDH<br>SANNIDHAM</h1>
    <div class="subtitle-hi">"एक आस्था, एक साधना, एक दिव्य अनुभव"</div>
    <div class="subtitle-en">A Sacred Space of Faith, Seva & Spirituality</div>
    <div class="cta-row">
      <a class="btn-primary-gold" href="<?php echo esc_url( home_url( '/live-aarti' ) ); ?>"><span class="live-dot"></span><span data-hi="लाइव दर्शन" data-en="Live Darshan">लाइव दर्शन</span></a>
      <a class="btn-outline-gold" href="<?php echo esc_url( home_url( '/visit-us' ) ); ?>"><span data-hi="यात्रा योजना" data-en="Plan Your Visit">यात्रा योजना</span></a>
      <a class="btn-outline-gold" href="<?php echo esc_url( home_url( '/donate' ) ); ?>"><span data-hi="दान करें" data-en="Donate">दान करें</span></a>
    </div>
    <?php $next = function_exists( 'siddh_next_aarti' ) ? siddh_next_aarti() : null; ?>
    <div style="position:absolute;right:40px;top:96px;text-align:right;display:none" class="ss-hero-side">
      <div class="live-badge" data-ss-temple-status>मंदिर खुला है</div>
      <div class="text-muted-ivory" style="font-size:12px;margin-top:12px" data-hi="अगली आरती" data-en="Next Aarti">अगली आरती</div>
      <div class="font-serif-en text-gold" style="font-size:28px;margin-top:4px"><?php echo esc_html( $next ? $next['time'] : '—' ); ?></div>
    </div>
  </div>
</section>
<style>@media(min-width:1024px){.ss-hero-side{display:block !important}}</style>
<!-- /wp:html -->
