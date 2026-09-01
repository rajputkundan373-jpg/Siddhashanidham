<?php
/**
 * Editable Home Page block content for Gutenberg.
 * Returned as a big block-markup string that gets saved to wp_posts.post_content.
 * Every section is a native editable block: Cover, Heading, Paragraph, Buttons, Image, Gallery, Query Loop.
 * Sections that need dynamic data (seva/events/aartis) are inserted as pattern blocks — the block-editor
 * user can still reorder, remove, or duplicate them, and edit patterns via Site Editor → Patterns.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

function siddh_home_page_content() {
    $hero_img = 'https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1800&q=90';
    $intro_img = 'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1600&q=85';
    $shani_img = 'https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1600&q=85';
    $bhandara_img = 'https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1600&q=85';
    $donate_img = 'https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1600&q=85';

    ob_start(); ?>
<!-- wp:html -->
<!-- SIDDH SANNIDHAM: HERO SECTION -->
<!-- /wp:html -->

<!-- wp:cover {"url":"<?php echo esc_url( $hero_img ); ?>","dimRatio":60,"customOverlayColor":"#0B0C10","minHeight":92,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"128px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-cover alignfull" style="padding:96px 24px 128px;min-height:92vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60" style="background-color:#0B0C10"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $hero_img ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
  <!-- wp:group {"layout":{"type":"constrained","contentSize":"1400px"}} -->
  <div class="wp-block-group">
    <!-- wp:paragraph {"style":{"typography":{"fontFamily":"'Tiro Devanagari Hindi',serif","fontSize":"18px","letterSpacing":"0.06em"},"color":{"text":"#E5C158"}}} -->
    <p style="color:#E5C158;font-family:'Tiro Devanagari Hindi',serif;font-size:18px;letter-spacing:0.06em">॥ ॐ नीलांजनसमाभासं रविपुत्रं यमाग्रजम् ॥</p>
    <!-- /wp:paragraph -->
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.4em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
    <p style="color:#D4AF37;font-size:12px;letter-spacing:0.4em;text-transform:uppercase">॥ श्री शनिदेवाय नमः ॥</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":1,"style":{"typography":{"fontFamily":"'Cinzel',serif","fontSize":"clamp(3rem,7vw,5.5rem)","lineHeight":"1.05"},"color":{"text":"#F6F4EE"}}} -->
    <h1 class="wp-block-heading" style="color:#F6F4EE;font-family:'Cinzel',serif;font-size:clamp(3rem,7vw,5.5rem);line-height:1.05">SIDDH<br>SANNIDHAM</h1>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"style":{"typography":{"fontFamily":"'Rozha One',serif","fontSize":"clamp(1.4rem,3vw,2rem)"},"color":{"text":"#D4AF37"}}} -->
    <p style="color:#D4AF37;font-family:'Rozha One',serif;font-size:clamp(1.4rem,3vw,2rem)">"एक आस्था, एक साधना, एक दिव्य अनुभव"</p>
    <!-- /wp:paragraph -->
    <!-- wp:paragraph {"style":{"typography":{"fontFamily":"'Cinzel',serif","fontStyle":"italic","fontSize":"18px"},"color":{"text":"#B0B7C3"}}} -->
    <p style="color:#B0B7C3;font-family:'Cinzel',serif;font-size:18px;font-style:italic">A Sacred Space of Faith, Seva & Spirituality</p>
    <!-- /wp:paragraph -->
    <!-- wp:buttons -->
    <div class="wp-block-buttons">
      <!-- wp:button {"className":"is-style-gold-primary"} -->
      <div class="wp-block-button is-style-gold-primary"><a class="wp-block-button__link wp-element-button" href="/live-aarti">LIVE DARSHAN</a></div>
      <!-- /wp:button -->
      <!-- wp:button {"className":"is-style-gold-outline"} -->
      <div class="wp-block-button is-style-gold-outline"><a class="wp-block-button__link wp-element-button" href="/visit-us">PLAN YOUR VISIT</a></div>
      <!-- /wp:button -->
      <!-- wp:button {"className":"is-style-gold-outline"} -->
      <div class="wp-block-button is-style-gold-outline"><a class="wp-block-button__link wp-element-button" href="/donate">DONATE</a></div>
      <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
  </div>
  <!-- /wp:group -->
</div></div>
<!-- /wp:cover -->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: INTRODUCTION SECTION -->
<!-- /wp:html -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:96px 24px">
  <!-- wp:columns {"verticalAlignment":"center"} -->
  <div class="wp-block-columns are-vertically-aligned-center">
    <!-- wp:column {"verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center">
      <!-- wp:image {"sizeSlug":"large","style":{"border":{"radius":"12px"}}} -->
      <figure class="wp-block-image size-large" style="border-radius:12px"><img src="<?php echo esc_url( $intro_img ); ?>" alt="Temple architecture"/></figure>
      <!-- /wp:image -->
    </div>
    <!-- /wp:column -->
    <!-- wp:column {"verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center">
      <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.32em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
      <p style="color:#D4AF37;font-size:12px;letter-spacing:0.32em;text-transform:uppercase">The Divine Presence of Shani Dev</p>
      <!-- /wp:paragraph -->
      <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"'Rozha One',serif"},"color":{"text":"#F6F4EE"}}} -->
      <h2 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif">सिद्ध सन्निधम्</h2>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","lineHeight":"1.9"},"color":{"text":"#F6F4EE"}}} -->
      <p style="color:#F6F4EE;font-size:18px;line-height:1.9">इटावा-ग्वालियर मार्ग पर स्थित सिद्ध सन्निधम् एक पावन शनि धाम है, जहाँ भक्त शनि देव के सम्मुख अपनी श्रद्धा एवं भक्ति समर्पित करते हैं। यह स्थान केवल एक मंदिर नहीं — यह न्याय, अनुशासन एवं सेवा का जीवंत केंद्र है।</p>
      <!-- /wp:paragraph -->
      <!-- wp:buttons -->
      <div class="wp-block-buttons">
        <!-- wp:button {"className":"is-style-gold-outline"} -->
        <div class="wp-block-button is-style-gold-outline"><a class="wp-block-button__link wp-element-button" href="/about">EXPLORE SIDDH SANNIDHAM</a></div>
        <!-- /wp:button -->
      </div>
      <!-- /wp:buttons -->
    </div>
    <!-- /wp:column -->
  </div>
  <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: LIVE DARSHAN + TODAY SECTION -->
<!-- /wp:html -->
<!-- wp:pattern {"slug":"siddh-sannidham/live-darshan"} /-->
<!-- wp:pattern {"slug":"siddh-sannidham/today-at-temple"} /-->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: SHANI DEV SECTION -->
<!-- /wp:html -->
<!-- wp:cover {"url":"<?php echo esc_url( $shani_img ); ?>","dimRatio":70,"customOverlayColor":"#0B0C10","align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-cover alignfull" style="padding:96px 24px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70" style="background-color:#0B0C10"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $shani_img ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
  <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
  <div class="wp-block-group">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.32em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
    <p style="color:#D4AF37;font-size:12px;letter-spacing:0.32em;text-transform:uppercase">Shani Dev</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"'Rozha One',serif","fontSize":"clamp(2rem,4vw,3rem)"},"color":{"text":"#F6F4EE"}}} -->
    <h2 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif;font-size:clamp(2rem,4vw,3rem)">शनि देव — न्याय, कर्म और अनुशासन के देवता</h2>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","lineHeight":"1.9"},"color":{"text":"#F6F4EE"}}} -->
    <p style="color:#F6F4EE;font-size:18px;line-height:1.9">शनि देव सूर्य पुत्र हैं और हिन्दू परंपरा में कर्मफल के देवता माने जाते हैं। उनकी दृष्टि उन भक्तों पर सदैव कृपापूर्ण होती है जो सत्य, विनम्रता एवं सेवा के मार्ग पर चलते हैं।</p>
    <!-- /wp:paragraph -->
    <!-- wp:buttons -->
    <div class="wp-block-buttons">
      <!-- wp:button {"className":"is-style-gold-outline"} -->
      <div class="wp-block-button is-style-gold-outline"><a class="wp-block-button__link wp-element-button" href="/shani-dev">DISCOVER SHANI DEV</a></div>
      <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
  </div>
  <!-- /wp:group -->
</div></div>
<!-- /wp:cover -->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: SEVA SECTION -->
<!-- /wp:html -->
<!-- wp:pattern {"slug":"siddh-sannidham/why-visit"} /-->
<!-- wp:pattern {"slug":"siddh-sannidham/seva"} /-->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: BHANDARA SECTION -->
<!-- /wp:html -->
<!-- wp:cover {"url":"<?php echo esc_url( $bhandara_img ); ?>","dimRatio":65,"customOverlayColor":"#0B0C10","align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-cover alignfull" style="padding:96px 24px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-65" style="background-color:#0B0C10"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $bhandara_img ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
  <!-- wp:group {"layout":{"type":"constrained","contentSize":"1200px"}} -->
  <div class="wp-block-group">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.32em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
    <p style="color:#D4AF37;font-size:12px;letter-spacing:0.32em;text-transform:uppercase">Bhandara</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"'Rozha One',serif"},"color":{"text":"#F6F4EE"}}} -->
    <h2 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif">भंडारा — सेवा जो प्रसाद बन जाए</h2>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","lineHeight":"1.9"},"color":{"text":"#F6F4EE"}}} -->
    <p style="color:#F6F4EE;font-size:18px;line-height:1.9">कोई भी भक्त बिना प्रसाद के मंदिर से न जाए — यह हमारा संकल्प है। शनिवार, अमावस्या एवं विशेष तिथियों पर आयोजित भंडारे में सम्मिलित हों।</p>
    <!-- /wp:paragraph -->
    <!-- wp:buttons -->
    <div class="wp-block-buttons">
      <!-- wp:button {"className":"is-style-gold-primary"} -->
      <div class="wp-block-button is-style-gold-primary"><a class="wp-block-button__link wp-element-button" href="/bhandara">SUPPORT BHANDARA</a></div>
      <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
  </div>
  <!-- /wp:group -->
</div></div>
<!-- /wp:cover -->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: EVENTS SECTION -->
<!-- /wp:html -->
<!-- wp:pattern {"slug":"siddh-sannidham/events"} /-->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: JOURNAL SECTION -->
<!-- /wp:html -->
<!-- wp:pattern {"slug":"siddh-sannidham/journal-categories"} /-->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:96px 24px">
  <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.32em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
  <p style="color:#D4AF37;font-size:12px;letter-spacing:0.32em;text-transform:uppercase">Journal</p>
  <!-- /wp:paragraph -->
  <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"'Rozha One',serif"},"color":{"text":"#F6F4EE"}}} -->
  <h2 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif">सिद्ध सन्निधम् जर्नल</h2>
  <!-- /wp:heading -->
  <!-- wp:query {"queryId":100,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false}} -->
  <div class="wp-block-query">
    <!-- wp:post-template {"style":{"spacing":{"blockGap":"24px"}}} -->
      <!-- wp:group {"className":"card-sacred","style":{"spacing":{"padding":"0px"}}} -->
      <div class="wp-block-group card-sacred" style="padding:0">
        <!-- wp:post-featured-image {"isLink":true,"height":"220px"} /-->
        <!-- wp:group {"style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}}} -->
        <div class="wp-block-group" style="padding:20px">
          <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px","letterSpacing":"0.24em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} /-->
          <!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontFamily":"'Cinzel',serif","fontSize":"18px"},"color":{"text":"#F6F4EE"}}} /-->
        </div>
        <!-- /wp:group -->
      </div>
      <!-- /wp:group -->
    <!-- /wp:post-template -->
  </div>
  <!-- /wp:query -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: GALLERY SECTION -->
<!-- /wp:html -->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:96px 24px">
  <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.32em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
  <p style="color:#D4AF37;font-size:12px;letter-spacing:0.32em;text-transform:uppercase">Gallery</p>
  <!-- /wp:paragraph -->
  <!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"'Rozha One',serif"},"color":{"text":"#F6F4EE"}}} -->
  <h2 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif">A Glimpse of Siddh Sannidham</h2>
  <!-- /wp:heading -->
  <!-- wp:gallery {"columns":3,"linkTo":"none","sizeSlug":"large"} -->
  <figure class="wp-block-gallery has-nested-images columns-3 is-cropped">
    <!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1200&q=85" alt="Temple"/></figure><!-- /wp:image -->
    <!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1200&q=85" alt="Sanctum"/></figure><!-- /wp:image -->
    <!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1200&q=85" alt="Shikhara"/></figure><!-- /wp:image -->
    <!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1200&q=85" alt="Gopuram"/></figure><!-- /wp:image -->
    <!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1200&q=85" alt="Aarti"/></figure><!-- /wp:image -->
    <!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1200&q=85" alt="Bhandara"/></figure><!-- /wp:image -->
  </figure>
  <!-- /wp:gallery -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: VISIT SECTION -->
<!-- /wp:html -->
<!-- wp:pattern {"slug":"siddh-sannidham/visit-temple"} /-->

<!-- wp:html -->
<!-- SIDDH SANNIDHAM: DONATION SECTION -->
<!-- /wp:html -->
<!-- wp:cover {"url":"<?php echo esc_url( $donate_img ); ?>","dimRatio":70,"customOverlayColor":"#0B0C10","align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-cover alignfull" style="padding:96px 24px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70" style="background-color:#0B0C10"></span><img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url( $donate_img ); ?>" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
  <!-- wp:group {"layout":{"type":"constrained","contentSize":"900px"}} -->
  <div class="wp-block-group" style="text-align:center">
    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"12px","letterSpacing":"0.32em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
    <p class="has-text-align-center" style="color:#D4AF37;font-size:12px;letter-spacing:0.32em;text-transform:uppercase">Donate</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"textAlign":"center","level":2,"style":{"typography":{"fontFamily":"'Rozha One',serif"},"color":{"text":"#F6F4EE"}}} -->
    <h2 class="wp-block-heading has-text-align-center" style="color:#F6F4EE;font-family:'Rozha One',serif">आपकी श्रद्धा, हमारी सेवा</h2>
    <!-- /wp:heading -->
    <!-- wp:paragraph {"align":"center","style":{"typography":{"fontFamily":"'Cinzel',serif","fontStyle":"italic","fontSize":"18px"},"color":{"text":"#B0B7C3"}}} -->
    <p class="has-text-align-center" style="color:#B0B7C3;font-family:'Cinzel',serif;font-size:18px;font-style:italic">Your faith becomes seva</p>
    <!-- /wp:paragraph -->
    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons">
      <!-- wp:button {"className":"is-style-gold-primary"} -->
      <div class="wp-block-button is-style-gold-primary"><a class="wp-block-button__link wp-element-button" href="/donate">DONATE</a></div>
      <!-- /wp:button -->
      <!-- wp:button {"className":"is-style-gold-outline"} -->
      <div class="wp-block-button is-style-gold-outline"><a class="wp-block-button__link wp-element-button" href="/seva">EXPLORE SEVA</a></div>
      <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
  </div>
  <!-- /wp:group -->
</div></div>
<!-- /wp:cover -->
<?php
    return ob_get_clean();
}
