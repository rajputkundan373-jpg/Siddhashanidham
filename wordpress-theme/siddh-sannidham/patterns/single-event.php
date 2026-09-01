<?php
/**
 * Title: Single Event
 * Slug: siddh-sannidham/single-event
 * Categories: siddh-sannidham
 * Inserter: false
 */
if ( ! is_singular( 'ss_event' ) ) return;
$id = get_the_ID();
$title_hi = get_post_meta( $id, '_ss_title_hi', true ) ?: get_the_title();
$title_en = get_post_meta( $id, '_ss_title_en', true ) ?: get_the_title();
$desc_hi = get_post_meta( $id, '_ss_desc_hi', true );
$desc_en = get_post_meta( $id, '_ss_desc_en', true );
$date = get_post_meta( $id, '_ss_event_date', true );
$time = get_post_meta( $id, '_ss_event_time', true );
$loc  = get_post_meta( $id, '_ss_event_location', true );
$cat  = get_post_meta( $id, '_ss_event_category', true );
$img  = get_the_post_thumbnail_url( $id, 'full' ) ?: 'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85';
?>
<!-- wp:html -->
<section style="position:relative;min-height:52vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="<?php echo esc_url( $img ); ?>" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.55"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow"><?php echo esc_html( $cat ); ?></div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="<?php echo esc_attr( $title_hi ); ?>" data-en="<?php echo esc_attr( $title_en ); ?>"><?php echo esc_html( $title_hi ); ?></span></h1>
    <div class="text-muted-ivory" style="margin-top:16px"><?php echo esc_html( siddh_format_date( $date ) ); ?><?php if ( $time ) echo ' · ' . esc_html( $time ); ?><?php if ( $loc ) echo ' · ' . esc_html( $loc ); ?></div>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>
<section class="ss-section">
  <div class="ss-container" style="max-width:800px">
    <p style="color:rgba(246,244,238,.85);line-height:1.9;font-size:18px"><span data-hi="<?php echo esc_attr( $desc_hi ); ?>" data-en="<?php echo esc_attr( $desc_en ); ?>"><?php echo esc_html( $desc_hi ); ?></span></p>
    <?php echo apply_filters( 'the_content', get_the_content() ); ?>
  </div>
</section>
<!-- /wp:html -->
