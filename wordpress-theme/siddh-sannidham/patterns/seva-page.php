<?php
/**
 * Title: Seva (Full Page)
 * Slug: siddh-sannidham/seva-page
 * Categories: siddh-sannidham
 */
$items = get_posts( array( 'post_type' => 'ss_seva', 'numberposts' => 24, 'orderby' => 'menu_order title', 'order' => 'ASC' ) );
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">SEVA</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="सेवा — भक्ति का अनुष्ठान" data-en="Seva — The Practice of Devotion">सेवा — भक्ति का अनुष्ठान</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="भक्तगण विभिन्न सेवाओं में सम्मिलित होकर पुण्य अर्जित कर सकते हैं।" data-en="Devotees can participate in various forms of seva and share in the merit.">भक्तगण विभिन्न सेवाओं में सम्मिलित होकर पुण्य अर्जित कर सकते हैं।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>
<section class="ss-section">
  <div class="ss-container ss-grid-2">
    <?php if ( ! empty( $items ) ) : foreach ( $items as $s ) :
      $hi = get_post_meta( $s->ID, '_ss_name_hi', true ) ?: $s->post_title;
      $en = get_post_meta( $s->ID, '_ss_name_en', true ) ?: $s->post_title;
      $dhi = get_post_meta( $s->ID, '_ss_desc_hi', true );
      $den = get_post_meta( $s->ID, '_ss_desc_en', true );
      $amt = (int) get_post_meta( $s->ID, '_ss_amount', true );
      $cat = get_post_meta( $s->ID, '_ss_category', true );
    ?>
      <div class="card-sacred" style="padding:32px">
        <div style="display:flex;justify-content:space-between;align-items:baseline">
          <h3 style="font-family:'Rozha One',serif;color:#F6F4EE;font-size:22px;margin:0"><span data-hi="<?php echo esc_attr( $hi ); ?>" data-en="<?php echo esc_attr( $en ); ?>"><?php echo esc_html( $hi ); ?></span></h3>
          <?php if ( $amt ) : ?><span class="text-gold" style="font-family:'Cinzel',serif">₹<?php echo esc_html( number_format( $amt ) ); ?></span><?php endif; ?>
        </div>
        <?php if ( $cat ) : ?><div class="ss-section-eyebrow" style="margin-top:8px"><?php echo esc_html( $cat ); ?></div><?php endif; ?>
        <p class="text-muted-ivory" style="margin-top:16px;line-height:1.7"><span data-hi="<?php echo esc_attr( $dhi ); ?>" data-en="<?php echo esc_attr( $den ); ?>"><?php echo esc_html( $dhi ); ?></span></p>
        <a class="btn-primary-gold" style="margin-top:20px;font-size:11px;padding:10px 18px" href="<?php echo esc_url( add_query_arg( array( 'purpose' => rawurlencode( $en ), 'amount' => $amt ), home_url( '/donate' ) ) ); ?>"><span data-hi="सेवा में सम्मिलित हों" data-en="Participate in Seva">सेवा में सम्मिलित हों</span></a>
      </div>
    <?php endforeach; else : ?>
      <p class="text-muted-ivory">कृपया व्यवस्थापक पैनल में सेवाएँ जोड़ें।</p>
    <?php endif; ?>
  </div>
</section>
</main>
<!-- /wp:html -->
