<?php
/**
 * Title: Shani Dev Page
 * Slug: siddh-sannidham/shani-dev-page
 * Categories: siddh-sannidham
 */
$topics = array(
  array( 'शनि देव कौन हैं?', 'Who is Shani Dev?', 'सूर्य पुत्र, कर्म फल के देवता।', 'Son of Surya, giver of the fruits of karma.' ),
  array( 'शनि देव और कर्म', 'Shani Dev & Karma', 'जैसा कर्म, वैसा फल।', 'As is the karma, so is the fruit.' ),
  array( 'शनि देव के मंत्र', 'Shani Mantras', 'शनि बीज मंत्र एवं गायत्री मंत्र।', 'Shani Beej Mantra and Gayatri Mantra.' ),
  array( 'शनिवार पूजन', 'Saturday Worship', 'विधिवत शनिवार पूजा एवं व्रत।', 'Traditional Saturday puja and vrat.' ),
  array( 'शनि जयंती', 'Shani Jayanti', 'शनि देव के प्राकट्य दिवस का उत्सव।', "Celebration of Shani Dev's appearance day." ),
  array( 'शनि अमावस्या', 'Shani Amavasya', 'विशेष अमावस्या अनुष्ठान।', 'Special Amavasya rituals.' ),
);
$faqs = array(
  array( 'शनि देव क्या न्याय करते हैं?', 'What does Shani Dev symbolise?', 'वे कर्मों के न्यायपूर्ण दृष्टा हैं।', 'He is the just observer of one’s karmas.' ),
  array( 'शनिवार को क्या करना शुभ है?', 'What is auspicious on Saturday?', 'सत्संग, दान, सेवा एवं सरसों के तेल का दीप।', 'Satsang, daan, seva and a mustard-oil diya.' ),
);
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">SHANI DEV</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1;max-width:900px"><span data-hi="शनि देव — न्याय, कर्म एवं अनुशासन" data-en="Shani Dev — Justice, Karma & Discipline">शनि देव — न्याय, कर्म एवं अनुशासन</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="ॐ नीलांजनसमाभासं रविपुत्रं यमाग्रजम् ।" data-en="Son of Surya, the deity of karma in Hindu tradition.">ॐ नीलांजनसमाभासं रविपुत्रं यमाग्रजम् ।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container" style="max-width:1200px">
    <p style="color:rgba(246,244,238,.85);line-height:1.9;font-size:18px"><span data-hi="शनि देव सूर्य पुत्र हैं और हिन्दू परंपरा में कर्मफल के देवता माने जाते हैं। उनकी आराधना श्रद्धा, अनुशासन एवं सत्य के साथ की जाती है।" data-en="Shani Dev is the son of Surya and, in the Hindu tradition, is revered as the deity of karma. His worship is performed with devotion, discipline and truth.">शनि देव सूर्य पुत्र हैं और हिन्दू परंपरा में कर्मफल के देवता माने जाते हैं।</span></p>

    <div class="ss-section-eyebrow" style="margin-top:64px" data-hi="शिक्षा" data-en="Learning">शिक्षा</div>
    <h2 class="hi">ज्ञान केंद्र</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div class="ss-grid-2">
      <?php foreach ( $topics as $t ) : ?>
        <div class="card-sacred">
          <h3 style="font-family:'Rozha One',serif;color:#D4AF37;font-size:20px;margin:0 0 8px"><span data-hi="<?php echo esc_attr( $t[0] ); ?>" data-en="<?php echo esc_attr( $t[1] ); ?>"><?php echo esc_html( $t[0] ); ?></span></h3>
          <p class="text-muted-ivory"><span data-hi="<?php echo esc_attr( $t[2] ); ?>" data-en="<?php echo esc_attr( $t[3] ); ?>"><?php echo esc_html( $t[2] ); ?></span></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="ss-section-eyebrow" style="margin-top:64px">FAQ</div>
    <h2 class="hi">प्रश्नोत्तर</h2>
    <div class="gold-underline" style="margin:16px 0 40px"></div>
    <div style="display:flex;flex-direction:column;gap:16px">
      <?php foreach ( $faqs as $f ) : ?>
        <details class="card-sacred" style="padding:20px">
          <summary style="cursor:pointer;list-style:none;display:flex;justify-content:space-between;color:#F6F4EE;font-family:'Rozha One',serif;font-size:18px"><span data-hi="<?php echo esc_attr( $f[0] ); ?>" data-en="<?php echo esc_attr( $f[1] ); ?>"><?php echo esc_html( $f[0] ); ?></span><span class="text-gold">+</span></summary>
          <p class="text-muted-ivory" style="margin-top:12px"><span data-hi="<?php echo esc_attr( $f[2] ); ?>" data-en="<?php echo esc_attr( $f[3] ); ?>"><?php echo esc_html( $f[2] ); ?></span></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</main>
<!-- /wp:html -->
