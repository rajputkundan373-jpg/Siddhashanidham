<?php
/**
 * Title: Seva
 * Slug: siddh-sannidham/seva
 * Categories: siddh-sannidham
 */
$seva_items = get_posts( array( 'post_type' => 'ss_seva', 'numberposts' => 6, 'orderby' => 'menu_order title', 'order' => 'ASC' ) );
?>
<!-- wp:html -->
<section class="ss-section bg-slate-t" style="border-top:1px solid rgba(212,175,55,.22);border-bottom:1px solid rgba(212,175,55,.22)">
  <div class="ss-container">
    <div class="ss-section-eyebrow">SEVA</div>
    <h2 class="hi">सिद्ध सन्निधम् में सेवा</h2>
    <div class="gold-underline" style="margin:16px 0 24px"></div>
    <p class="text-muted-ivory" style="max-width:720px;margin-bottom:40px" data-hi="भक्तगण विभिन्न सेवाओं में सम्मिलित होकर पुण्य लाभ अर्जित कर सकते हैं।" data-en="Devotees may participate in various forms of seva and share in the merit.">भक्तगण विभिन्न सेवाओं में सम्मिलित होकर पुण्य लाभ अर्जित कर सकते हैं।</p>
    <div class="ss-grid-3">
      <?php if ( ! empty( $seva_items ) ) : foreach ( $seva_items as $s ) :
        $hi = get_post_meta( $s->ID, '_ss_name_hi', true ) ?: $s->post_title;
        $en = get_post_meta( $s->ID, '_ss_name_en', true ) ?: $s->post_title;
        $desc_hi = get_post_meta( $s->ID, '_ss_desc_hi', true );
        $desc_en = get_post_meta( $s->ID, '_ss_desc_en', true );
        $amount  = (int) get_post_meta( $s->ID, '_ss_amount', true );
      ?>
        <div class="card-sacred">
          <div style="display:flex;justify-content:space-between;align-items:baseline;margin-bottom:12px">
            <h3 class="hi" style="font-family:'Rozha One',serif;color:#F6F4EE;margin:0;font-size:20px"><span data-hi="<?php echo esc_attr( $hi ); ?>" data-en="<?php echo esc_attr( $en ); ?>"><?php echo esc_html( $hi ); ?></span></h3>
            <?php if ( $amount ) : ?><span class="text-gold" style="font-family:'Cinzel',serif;font-size:14px">₹<?php echo esc_html( number_format( $amount ) ); ?></span><?php endif; ?>
          </div>
          <p class="text-muted-ivory" style="font-size:14px;line-height:1.7"><span data-hi="<?php echo esc_attr( $desc_hi ); ?>" data-en="<?php echo esc_attr( $desc_en ); ?>"><?php echo esc_html( $desc_hi ); ?></span></p>
          <a href="<?php echo esc_url( add_query_arg( array( 'purpose' => rawurlencode( $en ), 'amount' => $amount ), home_url( '/donate' ) ) ); ?>" style="margin-top:20px;display:inline-flex;color:#D4AF37;font-size:14px"><span data-hi="योगदान करें →" data-en="Contribute →">योगदान करें →</span></a>
        </div>
      <?php endforeach; else : ?>
        <p class="text-muted-ivory">कृपया व्यवस्थापक पैनल में सेवाएँ जोड़ें।</p>
      <?php endif; ?>
    </div>
  </div>
</section>
<!-- /wp:html -->
