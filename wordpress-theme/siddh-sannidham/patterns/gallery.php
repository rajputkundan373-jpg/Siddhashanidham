<?php
/**
 * Title: Gallery Grid
 * Slug: siddh-sannidham/gallery
 * Categories: siddh-sannidham
 */
$gallery = get_posts( array( 'post_type' => 'ss_gallery', 'numberposts' => 9 ) );
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container">
    <div class="ss-section-eyebrow">GALLERY</div>
    <h2 class="hi">गैलरी</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div style="columns:1;gap:24px" class="ss-gallery-cols">
      <?php foreach ( $gallery as $g ) : $img = get_the_post_thumbnail_url( $g->ID, 'large' ); if ( ! $img ) continue; ?>
        <div style="break-inside:avoid;margin-bottom:24px;overflow:hidden;border-radius:12px;border:1px solid rgba(212,175,55,.22)">
          <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $g->post_title ); ?>" style="width:100%;display:block">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<style>@media(min-width:640px){.ss-gallery-cols{columns:2 !important}} @media(min-width:1024px){.ss-gallery-cols{columns:3 !important}}</style>
<!-- /wp:html -->
