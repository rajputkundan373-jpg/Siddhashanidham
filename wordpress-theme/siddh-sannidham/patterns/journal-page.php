<?php
/**
 * Title: Journal (Full Page)
 * Slug: siddh-sannidham/journal-page
 * Categories: siddh-sannidham
 */
$posts = get_posts( array( 'numberposts' => 12 ) );
$featured = $posts[0] ?? null;
$rest = array_slice( $posts, 1 );
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
