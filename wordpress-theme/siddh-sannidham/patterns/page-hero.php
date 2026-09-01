<?php
/**
 * Title: Page Hero (reusable)
 * Slug: siddh-sannidham/page-hero
 * Categories: siddh-sannidham
 * Inserter: false
 */
$eyebrow = $args['eyebrow'] ?? '';
$title_hi = $args['title_hi'] ?? '';
$title_en = $args['title_en'] ?? '';
$sub_hi = $args['sub_hi'] ?? '';
$sub_en = $args['sub_en'] ?? '';
$image = $args['image'] ?? 'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85';
?>
<!-- wp:html -->
<section style="position:relative;min-height:52vh;overflow:hidden">
  <div style="position:absolute;inset:0">
    <img src="<?php echo esc_url( $image ); ?>" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5">
    <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,.5),rgba(11,12,16,1))"></div>
  </div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <?php if ( $eyebrow ) : ?><div class="ss-section-eyebrow"><?php echo esc_html( $eyebrow ); ?></div><?php endif; ?>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1;max-width:820px"><span data-hi="<?php echo esc_attr( $title_hi ); ?>" data-en="<?php echo esc_attr( $title_en ); ?>"><?php echo esc_html( $title_hi ); ?></span></h1>
    <?php if ( $sub_hi || $sub_en ) : ?>
      <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="<?php echo esc_attr( $sub_hi ); ?>" data-en="<?php echo esc_attr( $sub_en ); ?>"><?php echo esc_html( $sub_hi ); ?></span></p>
    <?php endif; ?>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>
<!-- /wp:html -->
