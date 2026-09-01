<?php
/**
 * Title: Journal Preview
 * Slug: siddh-sannidham/journal
 * Categories: siddh-sannidham
 */
$posts = get_posts( array( 'numberposts' => 3 ) );
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container">
    <div class="ss-section-eyebrow">JOURNAL</div>
    <h2 class="hi">सिद्ध सन्निधम् जर्नल</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div class="ss-grid-3">
      <?php foreach ( $posts as $p ) : $img = get_the_post_thumbnail_url( $p->ID, 'large' ); ?>
        <a href="<?php echo esc_url( get_permalink( $p ) ); ?>" class="card-sacred" style="display:block;padding:0;overflow:hidden">
          <?php if ( $img ) : ?><img src="<?php echo esc_url( $img ); ?>" alt="" style="width:100%;height:200px;object-fit:cover"><?php endif; ?>
          <div style="padding:20px">
            <div class="ss-section-eyebrow" style="margin-bottom:8px"><?php echo esc_html( strip_tags( get_the_category_list( ', ', '', $p->ID ) ) ); ?></div>
            <h3 style="color:#F6F4EE;font-family:'Cinzel',serif;font-size:18px;margin:0"><?php echo esc_html( get_the_title( $p ) ); ?></h3>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /wp:html -->
