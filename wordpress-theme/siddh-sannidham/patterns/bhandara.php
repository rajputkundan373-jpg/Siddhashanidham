<?php
/**
 * Title: Bhandara List
 * Slug: siddh-sannidham/bhandara
 * Categories: siddh-sannidham
 */
$bhandaras = get_posts( array( 'post_type' => 'ss_bhandara', 'numberposts' => 6, 'meta_key' => '_ss_bhandara_date', 'orderby' => 'meta_value', 'order' => 'ASC' ) );
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container">
    <div class="ss-section-eyebrow">BHANDARA</div>
    <h2 class="hi">भंडारा — सेवा और प्रसाद का उत्सव</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div class="ss-grid-3">
      <?php if ( ! empty( $bhandaras ) ) : foreach ( $bhandaras as $b ) :
        $title_hi = get_post_meta( $b->ID, '_ss_title_hi', true ) ?: $b->post_title;
        $title_en = get_post_meta( $b->ID, '_ss_title_en', true ) ?: $b->post_title;
        $desc_hi  = get_post_meta( $b->ID, '_ss_desc_hi', true );
        $desc_en  = get_post_meta( $b->ID, '_ss_desc_en', true );
        $date     = get_post_meta( $b->ID, '_ss_bhandara_date', true );
        $time     = get_post_meta( $b->ID, '_ss_bhandara_time', true );
        $sponsor  = (int) get_post_meta( $b->ID, '_ss_sponsor_amount', true );
        $img      = get_the_post_thumbnail_url( $b->ID, 'large' );
      ?>
        <div class="card-sacred" style="padding:0;overflow:hidden">
          <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="" style="width:100%;height:220px;object-fit:cover"><?php endif; ?>
          <div style="padding:24px">
            <h3 style="font-family:'Rozha One',serif;color:#F6F4EE;margin:0;font-size:20px"><span data-hi="<?php echo esc_attr( $title_hi ); ?>" data-en="<?php echo esc_attr( $title_en ); ?>"><?php echo esc_html( $title_hi ); ?></span></h3>
            <p class="text-muted-ivory" style="margin-top:12px;font-size:14px"><span data-hi="<?php echo esc_attr( $desc_hi ); ?>" data-en="<?php echo esc_attr( $desc_en ); ?>"><?php echo esc_html( $desc_hi ); ?></span></p>
            <div class="text-muted-ivory" style="margin-top:16px;font-size:13px"><?php echo esc_html( siddh_format_date( $date ) ); ?><?php if ( $time ) echo ' · ' . esc_html( $time ); ?></div>
            <?php if ( $sponsor ) : ?>
              <div style="display:flex;justify-content:space-between;align-items:center;margin-top:20px">
                <div>
                  <div class="text-muted-ivory" style="font-size:12px" data-hi="पूर्ण प्रायोजन" data-en="Full Sponsorship">पूर्ण प्रायोजन</div>
                  <div class="text-gold" style="font-family:'Cinzel',serif;font-size:18px">₹<?php echo esc_html( number_format( $sponsor ) ); ?></div>
                </div>
                <a class="btn-primary-gold" style="font-size:11px;padding:10px 18px" href="<?php echo esc_url( add_query_arg( array( 'purpose' => 'Bhandara+Seva', 'amount' => $sponsor ), home_url( '/donate' ) ) ); ?>"><span data-hi="प्रायोजित करें" data-en="Sponsor">प्रायोजित करें</span></a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; else : ?>
        <p class="text-muted-ivory">कोई आगामी भंडारा नहीं।</p>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /wp:html -->
