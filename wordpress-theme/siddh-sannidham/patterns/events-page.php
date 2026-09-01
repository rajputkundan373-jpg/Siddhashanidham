<?php
/**
 * Title: Events (Full Page)
 * Slug: siddh-sannidham/events-page
 * Categories: siddh-sannidham
 */
$events = get_posts( array( 'post_type' => 'ss_event', 'numberposts' => 24, 'meta_key' => '_ss_event_date', 'orderby' => 'meta_value', 'order' => 'ASC' ) );
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">EVENTS</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="आयोजन एवं उत्सव" data-en="Events & Celebrations">आयोजन एवं उत्सव</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="आगामी अनुष्ठान, महोत्सव एवं विशेष सेवाएँ।" data-en="Upcoming rituals, festivals and special observances.">आगामी अनुष्ठान, महोत्सव एवं विशेष सेवाएँ।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container ss-grid-2">
    <?php if ( ! empty( $events ) ) : foreach ( $events as $e ) :
      $title_hi = get_post_meta( $e->ID, '_ss_title_hi', true ) ?: $e->post_title;
      $title_en = get_post_meta( $e->ID, '_ss_title_en', true ) ?: $e->post_title;
      $desc_hi = get_post_meta( $e->ID, '_ss_desc_hi', true );
      $desc_en = get_post_meta( $e->ID, '_ss_desc_en', true );
      $date = get_post_meta( $e->ID, '_ss_event_date', true );
      $time = get_post_meta( $e->ID, '_ss_event_time', true );
      $loc  = get_post_meta( $e->ID, '_ss_event_location', true );
      $cat  = get_post_meta( $e->ID, '_ss_event_category', true );
      $img  = get_the_post_thumbnail_url( $e->ID, 'large' );
      $reg  = get_post_meta( $e->ID, '_ss_event_register_url', true );
      $don  = get_post_meta( $e->ID, '_ss_event_donate_url', true );
    ?>
      <a href="<?php echo esc_url( get_permalink( $e->ID ) ); ?>" class="card-sacred" style="display:block;padding:0;overflow:hidden">
        <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title_en ); ?>" style="width:100%;height:220px;object-fit:cover"><?php endif; ?>
        <div style="padding:24px">
          <div class="ss-section-eyebrow"><?php echo esc_html( $cat ); ?></div>
          <h3 style="font-family:'Rozha One',serif;color:#F6F4EE;margin:8px 0 12px;font-size:22px"><span data-hi="<?php echo esc_attr( $title_hi ); ?>" data-en="<?php echo esc_attr( $title_en ); ?>"><?php echo esc_html( $title_hi ); ?></span></h3>
          <p class="text-muted-ivory" style="font-size:14px;line-height:1.7"><span data-hi="<?php echo esc_attr( $desc_hi ); ?>" data-en="<?php echo esc_attr( $desc_en ); ?>"><?php echo esc_html( $desc_hi ); ?></span></p>
          <div class="text-muted-ivory" style="font-size:13px;margin-top:14px"><?php echo esc_html( siddh_format_date( $date ) ); ?><?php if ( $time ) echo ' · ' . esc_html( $time ); ?><?php if ( $loc ) echo ' · ' . esc_html( $loc ); ?></div>
          <?php if ( $reg || $don ) : ?>
            <div style="display:flex;gap:10px;margin-top:16px">
              <?php if ( $reg ) : ?><span class="btn-outline-gold" style="font-size:11px;padding:8px 14px"><span data-hi="पंजीकरण" data-en="Register">पंजीकरण</span></span><?php endif; ?>
              <?php if ( $don ) : ?><span class="btn-primary-gold" style="font-size:11px;padding:8px 14px"><span data-hi="दान" data-en="Donate">दान</span></span><?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </a>
    <?php endforeach; else : ?>
      <p class="text-muted-ivory">कोई आगामी आयोजन नहीं।</p>
    <?php endif; ?>
  </div>
</section>
</main>
<!-- /wp:html -->
