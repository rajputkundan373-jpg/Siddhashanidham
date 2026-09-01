<?php
/**
 * Title: Devotee Experiences Page
 * Slug: siddh-sannidham/experiences-page
 * Categories: siddh-sannidham
 */
$items = get_posts( array( 'post_type' => 'ss_testimonial', 'numberposts' => 24 ) );
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">EXPERIENCES</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="भक्तों के अनुभव" data-en="Devotee Experiences">भक्तों के अनुभव</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="सिद्ध सन्निधम् आने वाले भक्तों की श्रद्धांजलि।" data-en="Reflections shared by devotees who visited Siddh Sannidham.">सिद्ध सन्निधम् आने वाले भक्तों की श्रद्धांजलि।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container">
    <?php if ( ! empty( $items ) ) : ?>
    <div class="ss-grid-2">
      <?php foreach ( $items as $x ) :
        $hi = get_post_meta( $x->ID, '_ss_experience_hi', true );
        $en = get_post_meta( $x->ID, '_ss_experience_en', true );
        $city = get_post_meta( $x->ID, '_ss_city', true );
        $verified = get_post_meta( $x->ID, '_ss_verified', true );
      ?>
        <div class="card-sacred">
          <div style="font-family:'Cinzel',serif;font-style:italic;color:#F6F4EE;line-height:1.7">"<span data-hi="<?php echo esc_attr( $hi ); ?>" data-en="<?php echo esc_attr( $en ); ?>"><?php echo esc_html( $hi ?: $x->post_content ); ?></span>"</div>
          <div style="display:flex;justify-content:space-between;align-items:center;margin-top:20px">
            <div>
              <div class="text-gold"><?php echo esc_html( $x->post_title ); ?></div>
              <?php if ( $city ) : ?><div class="text-muted-ivory" style="font-size:12px"><?php echo esc_html( $city ); ?> · <?php echo esc_html( get_the_date( 'j F Y', $x ) ); ?></div><?php endif; ?>
            </div>
            <?php if ( $verified ) : ?><span class="text-gold" style="font-size:11px;border:1px solid rgba(212,175,55,.22);padding:4px 10px;border-radius:999px;text-transform:uppercase;letter-spacing:.2em" data-hi="सत्यापित" data-en="Verified">सत्यापित</span><?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php else : ?>
      <p class="text-muted-ivory">कोई अनुभव प्रकाशित नहीं। कृपया अपने अनुभव भेजें।</p>
    <?php endif; ?>
    <p style="font-size:12px;color:#B0B7C3;margin-top:32px" data-hi="असत्यापित चमत्कारी दावे स्वीकार नहीं किए जाते।" data-en="Unverifiable miracle claims will not be published as factual statements.">असत्यापित चमत्कारी दावे स्वीकार नहीं किए जाते।</p>
  </div>
</section>
</main>
<!-- /wp:html -->
