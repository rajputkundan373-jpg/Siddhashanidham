<?php
/**
 * Title: Events
 * Slug: siddh-sannidham/events
 * Categories: siddh-sannidham
 */
$events = get_posts( array( 'post_type' => 'ss_event', 'numberposts' => 3, 'meta_key' => '_ss_event_date', 'orderby' => 'meta_value', 'order' => 'ASC' ) );
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container">
    <div class="ss-section-eyebrow" data-hi="आगामी" data-en="Upcoming">आगामी</div>
    <h2 class="hi">आगामी आयोजन</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div class="ss-grid-3">
      <?php if ( ! empty( $events ) ) : foreach ( $events as $e ) :
        $title_hi = get_post_meta( $e->ID, '_ss_title_hi', true ) ?: $e->post_title;
        $title_en = get_post_meta( $e->ID, '_ss_title_en', true ) ?: $e->post_title;
        $date = get_post_meta( $e->ID, '_ss_event_date', true );
        $time = get_post_meta( $e->ID, '_ss_event_time', true );
        $cat  = get_post_meta( $e->ID, '_ss_event_category', true );
        $img  = get_the_post_thumbnail_url( $e->ID, 'large' );
      ?>
        <a href="<?php echo esc_url( get_permalink( $e->ID ) ); ?>" class="card-sacred" style="display:block;padding:0;overflow:hidden">
          <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $title_en ); ?>" style="width:100%;height:220px;object-fit:cover"><?php endif; ?>
          <div style="padding:24px">
            <div class="ss-section-eyebrow" style="margin-bottom:12px"><?php echo esc_html( $cat ); ?></div>
            <h3 style="font-family:'Rozha One',serif;color:#F6F4EE;margin:0;font-size:20px"><span data-hi="<?php echo esc_attr( $title_hi ); ?>" data-en="<?php echo esc_attr( $title_en ); ?>"><?php echo esc_html( $title_hi ); ?></span></h3>
            <div class="text-muted-ivory" style="margin-top:12px;font-size:14px"><?php echo esc_html( siddh_format_date( $date ) ); ?><?php if ( $time ) echo ' · ' . esc_html( $time ); ?></div>
          </div>
        </a>
      <?php endforeach; else : ?>
        <p class="text-muted-ivory">कोई आगामी आयोजन नहीं।</p>
      <?php endif; ?>
    </div>
    <div style="text-align:center;margin-top:48px">
      <a class="btn-outline-gold" href="<?php echo esc_url( home_url( '/events' ) ); ?>"><span data-hi="सभी आयोजन देखें" data-en="View All Events">सभी आयोजन देखें</span> →</a>
    </div>
  </div>
</section>
<!-- /wp:html -->
