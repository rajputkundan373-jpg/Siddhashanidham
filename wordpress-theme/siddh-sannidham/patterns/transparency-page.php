<?php
/**
 * Title: Transparency Page
 * Slug: siddh-sannidham/transparency-page
 * Categories: siddh-sannidham
 */
$items = array(
  array( 'दान का उपयोग', 'Donation Usage', 'सभी दान मंदिर संचालन, भंडारा एवं सेवा कार्यों में उपयोग होता है।', 'All donations are used for temple operations, bhandara and seva.' ),
  array( 'सेवा गतिविधियाँ', 'Seva Activities', 'अन्न सेवा, गौ सेवा एवं जरूरतमंद सहायता।', 'Anna seva, gau seva and support for the needy.' ),
  array( 'भंडारा गतिविधियाँ', 'Bhandara Activities', 'शनिवार, अमावस्या एवं विशेष तिथियों पर।', 'Held on Saturdays, Amavasya and special dates.' ),
  array( 'वार्षिक रिपोर्ट', 'Annual Updates', 'विस्तृत वित्तीय एवं सेवा रिपोर्ट शीघ्र।', 'Detailed financial & seva reports coming soon.' ),
);
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">TRANSPARENCY</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="पारदर्शिता" data-en="Temple Transparency">पारदर्शिता</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="भक्तों के प्रति हमारा उत्तरदायित्व।" data-en="Our accountability to our devotees.">भक्तों के प्रति हमारा उत्तरदायित्व।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container ss-grid-2">
    <?php foreach ( $items as $i ) : ?>
      <div class="card-sacred" style="padding:32px">
        <div class="ss-section-eyebrow"><span data-hi="<?php echo esc_attr( $i[0] ); ?>" data-en="<?php echo esc_attr( $i[1] ); ?>"><?php echo esc_html( $i[0] ); ?></span></div>
        <p style="color:rgba(246,244,238,.85);margin-top:16px;line-height:1.7"><span data-hi="<?php echo esc_attr( $i[2] ); ?>" data-en="<?php echo esc_attr( $i[3] ); ?>"><?php echo esc_html( $i[2] ); ?></span></p>
      </div>
    <?php endforeach; ?>
    <div style="grid-column:1/-1;text-align:center;color:#B0B7C3;margin-top:32px;font-size:14px"><span data-hi="वित्तीय आँकड़े शीघ्र प्रकाशित किए जाएंगे — कोई भी जानकारी बिना सत्यापन के प्रस्तुत नहीं की जाएगी।" data-en="Financial figures will be published as soon as verified — no unverified claim is presented here.">वित्तीय आँकड़े शीघ्र प्रकाशित किए जाएंगे।</span></div>
  </div>
</section>
</main>
<!-- /wp:html -->
