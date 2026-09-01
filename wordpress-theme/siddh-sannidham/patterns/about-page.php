<?php
/**
 * Title: About Page
 * Slug: siddh-sannidham/about-page
 * Categories: siddh-sannidham
 */
$sections = array(
    array( 'हमारी कथा', 'Our Story', 'सिद्ध सन्निधम् की स्थापना उस भाव से हुई जिसमें भक्त शनि देव के सम्मुख अपनी सच्चाई एवं श्रद्धा को समर्पित कर सकें।', 'Siddh Sannidham was founded so that devotees could offer their sincerity and devotion before Shani Dev.' ),
    array( 'हमारा उद्देश्य', 'Our Purpose', 'शनि साधना, सेवा, अनुशासन एवं सामुदायिक कल्याण को जीवंत रखना।', 'Keeping alive Shani sadhana, seva, discipline and community welfare.' ),
    array( 'हमारी परंपराएँ', 'Our Traditions', 'प्रतिदिन की आरती, शनिवार विशेष पूजन, अमावस्या अनुष्ठान एवं सामुदायिक भंडारा।', 'Daily aarti, special Saturday pujan, Amavasya rituals and community bhandaras.' ),
    array( 'हमारा दृष्टिकोण', 'Our Vision', 'एक ऐसा पावन केंद्र जो श्रद्धा एवं सेवा में सर्वप्रथम रहे।', 'A sacred centre that stands first in devotion and seva.' ),
);
$timeline = array(
    array( 'स्थापना', 'Foundation', 'सिद्ध सन्निधम् की नींव भक्ति, सेवा एवं शनि साधना के भाव से रखी गई।', 'Siddh Sannidham was founded with the intent of devotion, seva and Shani sadhana.' ),
    array( 'मुख्य विग्रह', 'Main Vigraha', 'शनि देव के पावन विग्रह की प्राण प्रतिष्ठा।', 'Prana pratishtha of the sacred Shani Dev vigraha.' ),
    array( 'सेवा विस्तार', 'Seva Expansion', 'अन्न सेवा, गौ सेवा एवं सामुदायिक भंडारे का शुभारंभ।', 'Launch of anna seva, gau seva and community bhandaras.' ),
    array( 'आज', 'Today', 'देश एवं विदेश के भक्तों से जुड़ी एक जीवंत आध्यात्मिक साधना।', 'A living spiritual practice connecting devotees across India and abroad.' ),
);
?>
<!-- wp:html -->
<main>
<?php echo do_blocks( '<!-- wp:pattern {"slug":"siddh-sannidham/page-hero"} /-->' ); // stub — we render inline for context ?>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">ABOUT</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1;max-width:820px"><span data-hi="सिद्ध सन्निधम् का परिचय" data-en="About Siddh Sannidham">सिद्ध सन्निधम् का परिचय</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="भक्ति, सेवा एवं शनि साधना का पावन केंद्र।" data-en="A sacred centre of devotion, seva and Shani sadhana.">भक्ति, सेवा एवं शनि साधना का पावन केंद्र।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container" style="max-width:1200px">
    <div style="display:grid;grid-template-columns:1fr;gap:40px" class="ss-about-grid">
      <?php foreach ( $sections as $s ) : ?>
        <div class="card-sacred" style="padding:32px">
          <h3 style="font-family:'Rozha One',serif;color:#F6F4EE;font-size:22px;margin:0 0 16px"><span data-hi="<?php echo esc_attr( $s[0] ); ?>" data-en="<?php echo esc_attr( $s[1] ); ?>"><?php echo esc_html( $s[0] ); ?></span></h3>
          <p style="line-height:1.9;color:rgba(246,244,238,.85);font-size:18px"><span data-hi="<?php echo esc_attr( $s[2] ); ?>" data-en="<?php echo esc_attr( $s[3] ); ?>"><?php echo esc_html( $s[2] ); ?></span></p>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="ss-section-eyebrow" style="margin-top:80px">TIMELINE</div>
    <h2 class="hi">हमारी यात्रा</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div style="position:relative;padding-left:24px;border-left:1px solid rgba(212,175,55,.22)">
      <?php foreach ( $timeline as $t ) : ?>
        <div style="position:relative;margin-bottom:40px">
          <span style="position:absolute;left:-31px;width:14px;height:14px;border-radius:50%;background:#0B0C10;border:1px solid rgba(212,175,55,.55);top:6px"></span>
          <div class="text-gold" style="font-size:14px;letter-spacing:.16em;text-transform:uppercase"><span data-hi="<?php echo esc_attr( $t[0] ); ?>" data-en="<?php echo esc_attr( $t[1] ); ?>"><?php echo esc_html( $t[0] ); ?></span></div>
          <p style="margin-top:8px;color:rgba(246,244,238,.85);line-height:1.7"><span data-hi="<?php echo esc_attr( $t[2] ); ?>" data-en="<?php echo esc_attr( $t[3] ); ?>"><?php echo esc_html( $t[2] ); ?></span></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<style>@media(min-width:768px){.ss-about-grid{grid-template-columns:1fr 1fr !important}}</style>
<!-- /wp:html -->
