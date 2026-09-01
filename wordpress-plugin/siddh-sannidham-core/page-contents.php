<?php
/**
 * Editable Gutenberg block content for every Siddh Sannidham page.
 *
 * Each function returns a native block-markup string used as `post_content`
 * when the corresponding page is seeded or reseeded from WP Admin →
 * Siddh Sannidham → Setup Pages.
 *
 * Design language (dark charcoal + antique gold + ivory typography) is
 * preserved via inline block styles that match the theme's CSS variables.
 * Every image, heading, paragraph, button label/URL and image ALT is
 * fully editable inside the Block Editor. Dynamic sections (Seva grid,
 * Events list, Bhandara list, Live Darshan iframe, Aarti schedule) are
 * inserted as `wp:pattern` blocks — their data lives in Custom Post Types
 * (also fully editable in WP Admin).
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ─────────── Shared block helpers ─────────── */

/**
 * Reusable page hero (Cover block with eyebrow + heading + subtitle).
 * Everything is native Gutenberg — editable inline, replaceable image, editable text.
 */
function siddh_hero_block( $img, $eyebrow, $title_hi, $title_en, $subtitle_hi = '', $subtitle_en = '' ) {
    $img = esc_url( $img );
    $eyebrow = esc_html( $eyebrow );
    $title_hi = esc_html( $title_hi );
    $title_en = esc_attr( $title_en );
    $sub = $subtitle_hi ? esc_html( $subtitle_hi ) : '';
    return <<<HTML
<!-- wp:cover {"url":"$img","dimRatio":60,"customOverlayColor":"#0B0C10","minHeight":45,"minHeightUnit":"vh","align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"64px","left":"24px","right":"24px"}}}} -->
<div class="wp-block-cover alignfull" style="padding:96px 24px 64px;min-height:45vh"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60" style="background-color:#0B0C10"></span><img class="wp-block-cover__image-background" alt="" src="$img" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
  <!-- wp:group {"layout":{"type":"constrained","contentSize":"1400px"}} -->
  <div class="wp-block-group">
    <!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.4em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
    <p style="color:#D4AF37;font-size:12px;letter-spacing:0.4em;text-transform:uppercase">$eyebrow</p>
    <!-- /wp:paragraph -->
    <!-- wp:heading {"level":1,"style":{"typography":{"fontFamily":"'Rozha One',serif","fontSize":"clamp(2rem,5vw,4rem)","lineHeight":"1.1"},"color":{"text":"#F6F4EE"}}} -->
    <h1 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);line-height:1.1">$title_hi</h1>
    <!-- /wp:heading -->
HTML
    . ( $sub ? "\n    <!-- wp:paragraph {\"style\":{\"typography\":{\"fontSize\":\"18px\"},\"color\":{\"text\":\"#B0B7C3\"}}} -->\n    <p style=\"color:#B0B7C3;font-size:18px\">{$sub}</p>\n    <!-- /wp:paragraph -->" : '' )
    . <<<HTML

    <!-- wp:separator {"style":{"spacing":{"margin":{"top":"24px"}}}} -->
    <hr class="wp-block-separator has-alpha-channel-opacity" style="margin-top:24px;width:64px;height:2px;background:#D4AF37;border:0"/>
    <!-- /wp:separator -->
  </div>
  <!-- /wp:group -->
</div></div>
<!-- /wp:cover -->
HTML;
}

/**
 * Eyebrow + heading + gold underline used above every section.
 */
function siddh_section_head( $eyebrow, $heading ) {
    $eyebrow = esc_html( $eyebrow );
    $heading = esc_html( $heading );
    return <<<HTML
<!-- wp:paragraph {"style":{"typography":{"fontSize":"12px","letterSpacing":"0.32em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} -->
<p style="color:#D4AF37;font-size:12px;letter-spacing:0.32em;text-transform:uppercase">$eyebrow</p>
<!-- /wp:paragraph -->
<!-- wp:heading {"level":2,"style":{"typography":{"fontFamily":"'Rozha One',serif"},"color":{"text":"#F6F4EE"}}} -->
<h2 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif">$heading</h2>
<!-- /wp:heading -->
<!-- wp:separator -->
<hr class="wp-block-separator has-alpha-channel-opacity" style="margin:16px 0 32px;width:64px;height:2px;background:#D4AF37;border:0"/>
<!-- /wp:separator -->
HTML;
}

/* ─────────── ABOUT ─────────── */
function siddh_about_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85',
        'ABOUT',
        'सिद्ध सन्निधम् का परिचय',
        'About Siddh Sannidham',
        'भक्ति, सेवा एवं शनि साधना का पावन केंद्र।'
    );
    $head = siddh_section_head( 'OUR STORY', 'हमारी कथा' );

    $sections = array(
        array( 'हमारी कथा', 'सिद्ध सन्निधम् की स्थापना उस भाव से हुई जिसमें भक्त शनि देव के सम्मुख अपनी सच्चाई एवं श्रद्धा को समर्पित कर सकें।' ),
        array( 'हमारा उद्देश्य', 'शनि साधना, सेवा, अनुशासन एवं सामुदायिक कल्याण को जीवंत रखना।' ),
        array( 'हमारी परंपराएँ', 'प्रतिदिन की आरती, शनिवार विशेष पूजन, अमावस्या अनुष्ठान एवं सामुदायिक भंडारा।' ),
        array( 'हमारा दृष्टिकोण', 'एक ऐसा पावन केंद्र जो श्रद्धा एवं सेवा में सर्वप्रथम रहे।' ),
    );

    $columns = '';
    foreach ( array_chunk( $sections, 2 ) as $pair ) {
        $columns .= '<!-- wp:columns -->' . "\n" . '<div class="wp-block-columns">' . "\n";
        foreach ( $pair as $s ) {
            $t = esc_html( $s[0] );
            $d = esc_html( $s[1] );
            $columns .= <<<COL
  <!-- wp:column -->
  <div class="wp-block-column">
    <!-- wp:group {"className":"card-sacred","style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"32px","right":"32px"}}}} -->
    <div class="wp-block-group card-sacred" style="padding:32px">
      <!-- wp:heading {"level":3,"style":{"typography":{"fontFamily":"'Rozha One',serif","fontSize":"22px"},"color":{"text":"#F6F4EE"}}} -->
      <h3 class="wp-block-heading" style="color:#F6F4EE;font-family:'Rozha One',serif;font-size:22px">$t</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","lineHeight":"1.9"},"color":{"text":"#F6F4EE"}}} -->
      <p style="color:#F6F4EE;font-size:18px;line-height:1.9">$d</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
  </div>
  <!-- /wp:column -->
COL;
        }
        $columns .= "\n" . '</div>' . "\n" . '<!-- /wp:columns -->' . "\n";
    }

    $body = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:96px 24px">
$head
$columns
</div>
<!-- /wp:group -->
HTML;

    return $hero . "\n\n" . $body;
}

/* ─────────── SHANI DEV ─────────── */
function siddh_shani_dev_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1800&q=85',
        'SHANI DEV',
        'शनि देव — न्याय, कर्म एवं अनुशासन',
        'Shani Dev — Justice, Karma & Discipline',
        'ॐ नीलांजनसमाभासं रविपुत्रं यमाग्रजम् ।'
    );
    $intro = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"96px","bottom":"48px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:96px 24px 48px">
  <!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","lineHeight":"1.9"},"color":{"text":"#F6F4EE"}}} -->
  <p style="color:#F6F4EE;font-size:18px;line-height:1.9">शनि देव सूर्य पुत्र हैं और हिन्दू परंपरा में कर्मफल के देवता माने जाते हैं। उनकी आराधना श्रद्धा, अनुशासन एवं सत्य के साथ की जाती है।</p>
  <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML;

    $topics = array(
        array( 'शनि देव कौन हैं?', 'सूर्य पुत्र, कर्म फल के देवता।' ),
        array( 'शनि देव और कर्म', 'जैसा कर्म, वैसा फल।' ),
        array( 'शनि देव के मंत्र', 'शनि बीज मंत्र एवं गायत्री मंत्र।' ),
        array( 'शनिवार पूजन', 'विधिवत शनिवार पूजा एवं व्रत।' ),
        array( 'शनि जयंती', 'शनि देव के प्राकट्य दिवस का उत्सव।' ),
        array( 'शनि अमावस्या', 'विशेष अमावस्या अनुष्ठान।' ),
    );

    $head_learn = siddh_section_head( 'LEARNING', 'ज्ञान केंद्र' );
    $topic_cards = '';
    foreach ( array_chunk( $topics, 2 ) as $pair ) {
        $topic_cards .= '<!-- wp:columns -->' . "\n" . '<div class="wp-block-columns">' . "\n";
        foreach ( $pair as $t ) {
            $title = esc_html( $t[0] );
            $desc  = esc_html( $t[1] );
            $topic_cards .= <<<COL
  <!-- wp:column -->
  <div class="wp-block-column">
    <!-- wp:group {"className":"card-sacred"} -->
    <div class="wp-block-group card-sacred">
      <!-- wp:heading {"level":3,"style":{"typography":{"fontFamily":"'Rozha One',serif","fontSize":"20px"},"color":{"text":"#D4AF37"}}} -->
      <h3 class="wp-block-heading" style="color:#D4AF37;font-family:'Rozha One',serif;font-size:20px">$title</h3>
      <!-- /wp:heading -->
      <!-- wp:paragraph {"style":{"color":{"text":"#B0B7C3"}}} -->
      <p style="color:#B0B7C3">$desc</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
  </div>
  <!-- /wp:column -->
COL;
        }
        $topic_cards .= "\n" . '</div>' . "\n" . '<!-- /wp:columns -->' . "\n";
    }

    $body = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"48px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:48px 24px 96px">
$head_learn
$topic_cards
</div>
<!-- /wp:group -->
HTML;

    return $hero . "\n\n" . $intro . "\n\n" . $body;
}

/* ─────────── DARSHAN ─────────── */
function siddh_darshan_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1800&q=85',
        'DARSHAN',
        'दर्शन',
        'Darshan',
        'शनि देव के पावन दर्शन का समय एवं मार्गदर्शन।'
    );
    // Dynamic darshan timings pattern (reads from admin settings).
    $darshan_pattern = '<!-- wp:pattern {"slug":"siddh-sannidham/darshan"} /-->';

    $guidelines = array(
        'स्वच्छ वस्त्र धारण करें',
        'गर्भगृह में मौन बनाए रखें',
        'चरण-पादुका बाहर उतारें',
        'पंक्ति एवं व्यवस्था का पालन करें',
        'तेल एवं तिल शनि देव को अर्पित करें',
        'प्रसाद को श्रद्धा से ग्रहण करें',
    );
    $head = siddh_section_head( 'GUIDELINES', 'दर्शन दिशानिर्देश' );
    $cards = '';
    foreach ( array_chunk( $guidelines, 2 ) as $pair ) {
        $cards .= '<!-- wp:columns -->' . "\n" . '<div class="wp-block-columns">' . "\n";
        foreach ( $pair as $g ) {
            $g = esc_html( $g );
            $cards .= <<<COL
  <!-- wp:column -->
  <div class="wp-block-column">
    <!-- wp:group {"className":"card-sacred"} -->
    <div class="wp-block-group card-sacred">
      <!-- wp:paragraph {"style":{"color":{"text":"#F6F4EE"}}} -->
      <p style="color:#F6F4EE"><span style="color:#D4AF37;margin-right:8px">◈</span> $g</p>
      <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
  </div>
  <!-- /wp:column -->
COL;
        }
        $cards .= "\n" . '</div>' . "\n" . '<!-- /wp:columns -->' . "\n";
    }
    $cta = <<<HTML
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
  <!-- wp:button {"className":"is-style-gold-primary"} -->
  <div class="wp-block-button is-style-gold-primary"><a class="wp-block-button__link wp-element-button" href="https://maps.google.com/?q=Etawa+Gwalior+Road+Madhya+Pradesh" target="_blank" rel="noreferrer noopener">GET DIRECTIONS</a></div>
  <!-- /wp:button -->
</div>
<!-- /wp:buttons -->
HTML;

    $body = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"64px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:64px 24px 96px">
$head
$cards
$cta
</div>
<!-- /wp:group -->
HTML;

    return $hero . "\n\n" . $darshan_pattern . "\n\n" . $body;
}

/* ─────────── SEVA ─────────── */
function siddh_seva_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85',
        'SEVA',
        'सेवा — भक्ति का अनुष्ठान',
        'Seva — The Practice of Devotion',
        'भक्तगण विभिन्न सेवाओं में सम्मिलित होकर पुण्य अर्जित कर सकते हैं।'
    );
    // Seva list is CPT-driven — admin edits Seva items under WP Admin → Seva Options.
    $seva_pattern = '<!-- wp:pattern {"slug":"siddh-sannidham/seva"} /-->';
    return $hero . "\n\n" . $seva_pattern;
}

/* ─────────── BHANDARA ─────────── */
function siddh_bhandara_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85',
        'BHANDARA',
        'भंडारा — सेवा और प्रसाद का उत्सव',
        'Bhandara — A Celebration of Seva & Prasad',
        'कोई भी भक्त बिना प्रसाद के मंदिर से न जाए।'
    );
    // Bhandara list is CPT-driven — admin edits Bhandaras under WP Admin → Bhandaras.
    $pattern = '<!-- wp:pattern {"slug":"siddh-sannidham/bhandara"} /-->';
    return $hero . "\n\n" . $pattern;
}

/* ─────────── LIVE AARTI ─────────── */
function siddh_live_aarti_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1800&q=85',
        'LIVE',
        'लाइव आरती एवं दर्शन',
        'Live Aarti & Darshan',
        'अब दूरी नहीं, दर्शन का अवसर हर समय।'
    );
    // Live darshan video player + today's aartis (URL from admin settings → Live Darshan).
    $player = '<!-- wp:pattern {"slug":"siddh-sannidham/live-darshan"} /-->';
    // Editable lyrics card
    $head = siddh_section_head( 'AARTI LYRICS', 'आरती के बोल' );
    $lyrics_body = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"64px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"800px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:64px 24px 96px">
$head
<!-- wp:group {"className":"card-sacred","style":{"spacing":{"padding":{"top":"32px","bottom":"32px","left":"32px","right":"32px"}}}} -->
<div class="wp-block-group card-sacred" style="padding:32px">
  <!-- wp:paragraph {"style":{"typography":{"fontFamily":"'Tiro Devanagari Hindi',serif","fontSize":"18px","lineHeight":"2","letterSpacing":"0.04em"},"color":{"text":"#F6F4EE"}}} -->
  <p style="color:#F6F4EE;font-family:'Tiro Devanagari Hindi',serif;font-size:18px;line-height:2;letter-spacing:0.04em">जय जय श्री शनि देव भक्तन हितकारी।<br>सूरज के पुत्र प्रभु छाया महतारी॥</p>
  <!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->
HTML;

    return $hero . "\n\n" . $player . "\n\n" . $lyrics_body;
}

/* ─────────── EVENTS ─────────── */
function siddh_events_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85',
        'EVENTS',
        'आयोजन एवं उत्सव',
        'Events & Celebrations',
        'आगामी अनुष्ठान, महोत्सव एवं विशेष सेवाएँ।'
    );
    // Events list is CPT-driven — admin edits Events under WP Admin → Events.
    $pattern = '<!-- wp:pattern {"slug":"siddh-sannidham/events"} /-->';
    return $hero . "\n\n" . $pattern;
}

/* ─────────── JOURNAL ─────────── */
function siddh_journal_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1800&q=85',
        'JOURNAL',
        'सिद्ध सन्निधम् जर्नल',
        'Siddh Sannidham Journal',
        'आध्यात्मिक ज्ञान, शनि साधना एवं मंदिर परंपरा पर लेख।'
    );
    // Editable heading + native Query Loop for latest posts (fully editable in Site Editor).
    $head = siddh_section_head( 'LATEST', 'नवीनतम लेख' );
    $body = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"64px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:64px 24px 96px">
$head
<!-- wp:query {"queryId":200,"query":{"perPage":"12","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":false}} -->
<div class="wp-block-query">
  <!-- wp:post-template {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"grid","columnCount":3}} -->
    <!-- wp:group {"className":"card-sacred","style":{"spacing":{"padding":"0px"}}} -->
    <div class="wp-block-group card-sacred" style="padding:0">
      <!-- wp:post-featured-image {"isLink":true,"height":"220px"} /-->
      <!-- wp:group {"style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"20px","right":"20px"}}}} -->
      <div class="wp-block-group" style="padding:20px">
        <!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"12px","letterSpacing":"0.24em","textTransform":"uppercase"},"color":{"text":"#D4AF37"}}} /-->
        <!-- wp:post-title {"isLink":true,"level":3,"style":{"typography":{"fontFamily":"'Cinzel',serif","fontSize":"18px"},"color":{"text":"#F6F4EE"}}} /-->
        <!-- wp:post-excerpt {"moreText":"पढ़ें →","style":{"typography":{"fontSize":"14px"},"color":{"text":"#B0B7C3"}}} /-->
      </div>
      <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
  <!-- /wp:post-template -->
  <!-- wp:query-pagination -->
  <div class="wp-block-query-pagination">
    <!-- wp:query-pagination-previous /-->
    <!-- wp:query-pagination-numbers /-->
    <!-- wp:query-pagination-next /-->
  </div>
  <!-- /wp:query-pagination -->
  <!-- wp:query-no-results -->
  <!-- wp:paragraph {"style":{"color":{"text":"#B0B7C3"}}} -->
  <p style="color:#B0B7C3">कोई लेख नहीं मिला।</p>
  <!-- /wp:paragraph -->
  <!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->
</div>
<!-- /wp:group -->
HTML;

    return $hero . "\n\n" . $body;
}

/* ─────────── GALLERY ─────────── */
function siddh_gallery_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1800&q=85',
        'GALLERY',
        'गैलरी',
        'Gallery',
        'मंदिर, आरती, भंडारा एवं उत्सवों की झलक।'
    );
    // Native Gutenberg gallery — admin can add/remove/reorder/replace images via Media Library.
    $imgs = array(
        'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1200&q=85',
        'https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1200&q=85',
        'https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1200&q=85',
        'https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1200&q=85',
        'https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1200&q=85',
        'https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1200&q=85',
        'https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1200&q=85',
        'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1200&q=85',
        'https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1200&q=85',
    );
    $gallery_items = '';
    foreach ( $imgs as $i => $u ) {
        $u = esc_url( $u );
        $alt = esc_attr( 'Siddh Sannidham gallery ' . ( $i + 1 ) );
        $gallery_items .= '<!-- wp:image {"sizeSlug":"large"} --><figure class="wp-block-image size-large"><img src="' . $u . '" alt="' . $alt . '"/></figure><!-- /wp:image -->' . "\n";
    }
    $head = siddh_section_head( 'GALLERY', 'गैलरी' );
    $body = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"64px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:64px 24px 96px">
$head
<!-- wp:gallery {"columns":3,"linkTo":"none","sizeSlug":"large"} -->
<figure class="wp-block-gallery has-nested-images columns-3 is-cropped">
$gallery_items
</figure>
<!-- /wp:gallery -->
</div>
<!-- /wp:group -->
HTML;

    return $hero . "\n\n" . $body;
}

/* ─────────── VISIT US ─────────── */
function siddh_visit_us_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1800&q=85',
        'VISIT',
        'यात्रा योजना',
        'Plan Your Visit',
        'इटावा-ग्वालियर मार्ग, मध्य प्रदेश।'
    );
    // Visit info + map is settings-driven via existing pattern.
    $pattern = '<!-- wp:pattern {"slug":"siddh-sannidham/visit-temple"} /-->';
    return $hero . "\n\n" . $pattern;
}

/* ─────────── CONTACT ─────────── */
function siddh_contact_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1800&q=85',
        'CONTACT',
        'संपर्क सिद्ध सन्निधम्',
        'Contact Siddh Sannidham',
        'हमसे संपर्क करें।'
    );
    // Contact form + settings-driven info via shortcode (admin edits phone/email/address in Settings).
    $form = '<!-- wp:shortcode -->[siddh_contact_form]<!-- /wp:shortcode -->';
    return $hero . "\n\n" . $form;
}

/* ─────────── DONATE ─────────── */
function siddh_donate_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1800&q=85',
        'DONATE',
        'आपकी श्रद्धा, हमारी सेवा',
        'Your Faith, Our Seva',
        'मंदिर, भंडारा एवं सेवा कार्यों में अपना योगदान दें।'
    );
    // Donation form + UPI/bank info via shortcodes (fully editable via admin settings; Razorpay-ready).
    $form = '<!-- wp:shortcode -->[siddh_donate_page]<!-- /wp:shortcode -->';
    return $hero . "\n\n" . $form;
}

/* ─────────── EXPERIENCES ─────────── */
function siddh_experiences_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85',
        'EXPERIENCES',
        'भक्तों के अनुभव',
        'Devotee Experiences',
        'सिद्ध सन्निधम् आने वाले भक्तों की श्रद्धांजलि।'
    );
    // Testimonials via existing pattern (data lives in ss_testimonial CPT).
    $pattern = '<!-- wp:pattern {"slug":"siddh-sannidham/experiences-page"} /-->';
    return $hero . "\n\n" . $pattern;
}

/* ─────────── TRANSPARENCY ─────────── */
function siddh_transparency_page_content() {
    $hero = siddh_hero_block(
        'https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85',
        'TRANSPARENCY',
        'पारदर्शिता',
        'Temple Transparency',
        'दान, सेवा एवं व्यय की खुली जानकारी।'
    );
    $head = siddh_section_head( 'OUR COMMITMENT', 'हमारी प्रतिबद्धता' );
    $body = <<<HTML
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"64px","bottom":"96px","left":"24px","right":"24px"}},"color":{"background":"#0B0C10"}},"layout":{"type":"constrained","contentSize":"1000px"}} -->
<div class="wp-block-group alignfull has-background" style="background-color:#0B0C10;padding:64px 24px 96px">
$head
<!-- wp:paragraph {"style":{"typography":{"fontSize":"18px","lineHeight":"1.9"},"color":{"text":"#F6F4EE"}}} -->
<p style="color:#F6F4EE;font-size:18px;line-height:1.9">सिद्ध सन्निधम् प्रत्येक भक्त की श्रद्धा एवं दान के प्रति उत्तरदायी है। हम अपनी सेवाओं, दान एवं भंडारे के आयोजनों का पूर्ण विवरण नियमित रूप से यहाँ प्रकाशित करते हैं।</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML;
    return $hero . "\n\n" . $body;
}

/* ─────────── Master mapping ─────────── */
function siddh_page_content_map() {
    return array(
        'home'         => 'siddh_home_page_content',
        'about'        => 'siddh_about_page_content',
        'shani-dev'    => 'siddh_shani_dev_page_content',
        'darshan'      => 'siddh_darshan_page_content',
        'seva'         => 'siddh_seva_page_content',
        'bhandara'     => 'siddh_bhandara_page_content',
        'live-aarti'   => 'siddh_live_aarti_page_content',
        'events'       => 'siddh_events_page_content',
        'journal'      => 'siddh_journal_page_content',
        'gallery'      => 'siddh_gallery_page_content',
        'visit-us'     => 'siddh_visit_us_page_content',
        'contact'      => 'siddh_contact_page_content',
        'donate'       => 'siddh_donate_page_content',
        'experiences'  => 'siddh_experiences_page_content',
        'transparency' => 'siddh_transparency_page_content',
    );
}
