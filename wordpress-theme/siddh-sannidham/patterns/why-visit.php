<?php
/**
 * Title: Why Devotees Visit
 * Slug: siddh-sannidham/why-visit
 * Categories: siddh-sannidham
 */
$cards = array(
  array( 'hi' => 'दर्शन', 'en' => 'Darshan', 'd_hi' => 'पावन गर्भगृह में शनि देव के दर्शन।', 'd_en' => 'Darshan of Shani Dev in the sacred sanctum.' ),
  array( 'hi' => 'पूजन', 'en' => 'Pujan', 'd_hi' => 'पारंपरिक विधि से अभिषेक एवं पूजन।', 'd_en' => 'Traditional abhishekam and pujan rituals.' ),
  array( 'hi' => 'शनिवार सेवा', 'en' => 'Saturday Seva', 'd_hi' => 'हर शनिवार विशेष आरती एवं सेवा।', 'd_en' => 'Special Saturday aarti and dedicated seva.' ),
  array( 'hi' => 'भंडारा', 'en' => 'Bhandara', 'd_hi' => 'सात्विक प्रसाद, सामुदायिक भोजन।', 'd_en' => 'Sattvic prasad and community meal.' ),
  array( 'hi' => 'विशेष अनुष्ठान', 'en' => 'Special Rituals', 'd_hi' => 'अमावस्या एवं जयंती के अनुष्ठान।', 'd_en' => 'Rituals on Amavasya and Jayanti.' ),
  array( 'hi' => 'सामुदायिक सेवा', 'en' => 'Community Seva', 'd_hi' => 'गौ सेवा, अन्न सेवा एवं जरूरतमंद सेवा।', 'd_en' => 'Gau seva, food seva and support for the needy.' ),
);
?>
<!-- wp:html -->
<section class="ss-section">
  <div class="ss-container">
    <div class="ss-section-eyebrow" data-hi="दर्शनार्थियों के लिए" data-en="For Devotees">दर्शनार्थियों के लिए</div>
    <h2 class="hi">क्यों करें सिद्ध सन्निधम् की यात्रा</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div class="ss-grid-3">
      <?php foreach ( $cards as $c ) : ?>
        <div class="card-sacred" style="padding:32px">
          <div style="width:48px;height:48px;border-radius:50%;border:1px solid rgba(212,175,55,.55);display:flex;align-items:center;justify-content:center;margin-bottom:24px">
            <span class="text-gold font-serif-en" aria-hidden="true">◈</span>
          </div>
          <h3 class="hi" style="font-family:'Rozha One',serif;font-size:24px;color:#F6F4EE;margin:0"><span data-hi="<?php echo esc_attr( $c['hi'] ); ?>" data-en="<?php echo esc_attr( $c['en'] ); ?>"><?php echo esc_html( $c['hi'] ); ?></span></h3>
          <p class="text-muted-ivory" style="margin-top:12px;line-height:1.7"><span data-hi="<?php echo esc_attr( $c['d_hi'] ); ?>" data-en="<?php echo esc_attr( $c['d_en'] ); ?>"><?php echo esc_html( $c['d_hi'] ); ?></span></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<!-- /wp:html -->
