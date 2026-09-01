<?php
/**
 * Title: Journal (Full Page)
 * Slug: siddh-sannidham/journal-page
 * Categories: siddh-sannidham
 */
$active_cat = isset( $_GET['cat'] ) ? sanitize_text_field( wp_unslash( $_GET['cat'] ) ) : '';
$active_q   = isset( $_GET['q'] )   ? sanitize_text_field( wp_unslash( $_GET['q'] ) )   : '';

$q_args = array( 'numberposts' => 24, 's' => $active_q );
if ( $active_cat ) {
    $term = get_term_by( 'name', $active_cat, 'category' );
    if ( $term ) $q_args['category'] = $term->term_id;
}
$posts = get_posts( $q_args );
$featured = ( ! $active_cat && ! $active_q ) ? ( $posts[0] ?? null ) : null;
$rest = $featured ? array_slice( $posts, 1 ) : $posts;
$all_cats = get_terms( array( 'taxonomy' => 'category', 'hide_empty' => false ) );
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">JOURNAL</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="सिद्ध सन्निधम् जर्नल" data-en="Siddh Sannidham Journal">सिद्ध सन्निधम् जर्नल</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="आध्यात्मिक ज्ञान, शनि साधना एवं मंदिर परंपरा पर लेख।" data-en="Essays on spiritual wisdom, Shani sadhana and temple traditions.">आध्यात्मिक ज्ञान, शनि साधना एवं मंदिर परंपरा पर लेख।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container">
    <form method="get" style="max-width:720px;margin-bottom:32px">
      <input class="ss-input" style="border-radius:999px;padding:14px 24px" type="text" name="q" value="<?php echo esc_attr( $active_q ); ?>" placeholder="लेख खोजें... / Search articles...">
    </form>
    <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:40px">
      <a href="<?php echo esc_url( home_url( '/journal' ) ); ?>" class="btn-outline-gold" style="<?php echo $active_cat ? '' : 'background:#D4AF37;color:#0B0C10;border-color:transparent'; ?>;font-size:11px;padding:8px 16px"><span data-hi="सभी" data-en="All">सभी</span></a>
      <?php foreach ( $all_cats as $t ) : $is_active = $active_cat === $t->name; ?>
        <a href="<?php echo esc_url( home_url( '/journal?cat=' . rawurlencode( $t->name ) ) ); ?>" class="btn-outline-gold" style="<?php echo $is_active ? 'background:#D4AF37;color:#0B0C10;border-color:transparent' : ''; ?>;font-size:11px;padding:8px 16px"><?php echo esc_html( $t->name ); ?></a>
      <?php endforeach; ?>
    </div>

    <?php if ( $featured ) : $img = get_the_post_thumbnail_url( $featured->ID, 'large' ); ?>
      <a href="<?php echo esc_url( get_permalink( $featured ) ); ?>" class="card-sacred" style="display:grid;grid-template-columns:1fr;padding:0;overflow:hidden;margin-bottom:64px" id="ss-featured">
        <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="" style="width:100%;height:100%;object-fit:cover;min-height:280px"><?php endif; ?>
        <div style="padding:32px;display:flex;flex-direction:column;justify-content:center">
          <div class="ss-section-eyebrow"><?php echo esc_html( strip_tags( get_the_category_list( ', ', '', $featured->ID ) ) ); ?> · FEATURED</div>
          <h3 style="font-family:'Rozha One',serif;color:#F6F4EE;font-size:28px;margin:12px 0"><?php echo esc_html( get_the_title( $featured ) ); ?></h3>
          <p class="text-muted-ivory" style="line-height:1.7"><?php echo esc_html( get_the_excerpt( $featured ) ); ?></p>
        </div>
      </a>
    <?php endif; ?>

    <?php if ( empty( $rest ) && ! $featured ) : ?>
      <p class="text-muted-ivory"><span data-hi="कोई लेख नहीं मिला।" data-en="No articles found.">कोई लेख नहीं मिला।</span></p>
    <?php endif; ?>

    <div class="ss-grid-3">
      <?php foreach ( $rest as $p ) : $img = get_the_post_thumbnail_url( $p->ID, 'large' ); ?>
        <a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="card-sacred" style="display:block;padding:0;overflow:hidden">
          <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="" style="width:100%;height:200px;object-fit:cover"><?php endif; ?>
          <div style="padding:20px">
            <div class="ss-section-eyebrow"><?php echo esc_html( strip_tags( get_the_category_list( ', ', '', $p->ID ) ) ); ?></div>
            <h4 style="color:#F6F4EE;font-family:'Cinzel',serif;font-size:18px;margin:8px 0 0"><?php echo esc_html( get_the_title( $p ) ); ?></h4>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<style>@media(min-width:768px){#ss-featured{grid-template-columns:1fr 1fr !important}}</style>
<!-- /wp:html -->
