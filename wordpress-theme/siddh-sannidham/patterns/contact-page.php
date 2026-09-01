<?php
/**
 * Title: Contact Page
 * Slug: siddh-sannidham/contact-page
 * Categories: siddh-sannidham
 */
$phone    = siddh_get_option( 'phone', '' );
$whatsapp = siddh_get_option( 'whatsapp', '' );
$email    = siddh_get_option( 'email', '' );
$address_hi = siddh_get_option( 'address_hi', 'इटावा-ग्वालियर मार्ग, मध्य प्रदेश, भारत' );
$address_en = siddh_get_option( 'address_en', 'Etawa–Gwalior Road, Madhya Pradesh, India' );
$wa_digits = preg_replace( '/\D/', '', $whatsapp );
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">CONTACT</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="संपर्क सिद्ध सन्निधम्" data-en="Contact Siddh Sannidham">संपर्क सिद्ध सन्निधम्</span></h1>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container" style="display:grid;grid-template-columns:1fr;gap:40px" id="contact-grid">
    <form data-ss-form="contact" class="card-sacred" style="padding:32px">
      <h2 style="font-family:'Rozha One',serif;color:#F6F4EE;font-size:24px;margin:0 0 24px"><span data-hi="संदेश भेजें" data-en="Send a Message">संदेश भेजें</span></h2>
      <div style="display:flex;flex-direction:column;gap:16px">
        <input class="ss-input" name="name" required placeholder="नाम / Name">
        <input class="ss-input" name="mobile" required placeholder="मोबाइल / Mobile">
        <input class="ss-input" type="email" name="email" required placeholder="ईमेल / Email">
        <textarea class="ss-textarea" name="message" rows="5" required placeholder="संदेश / Message"></textarea>
      </div>
      <button class="btn-primary-gold" type="submit" style="margin-top:24px"><span data-hi="भेजें" data-en="Send Message">भेजें</span></button>
      <span data-ss-form-msg style="display:block;font-size:12px;color:#B0B7C3;margin-top:12px"></span>
    </form>

    <div style="display:flex;flex-direction:column;gap:24px">
      <div class="card-sacred" style="display:flex;gap:16px">
        <div>
          <div class="ss-section-eyebrow" data-hi="पता" data-en="Address">पता</div>
          <div class="text-ivory" style="margin-top:6px"><span data-hi="<?php echo esc_attr( $address_hi ); ?>" data-en="<?php echo esc_attr( $address_en ); ?>"><?php echo esc_html( $address_hi ); ?></span></div>
        </div>
      </div>
      <?php if ( $phone ) : ?><div class="card-sacred"><div class="ss-section-eyebrow" data-hi="फ़ोन" data-en="Phone">फ़ोन</div><div class="text-ivory" style="margin-top:6px"><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" style="color:inherit"><?php echo esc_html( $phone ); ?></a></div></div><?php endif; ?>
      <?php if ( $whatsapp ) : ?><div class="card-sacred"><div class="ss-section-eyebrow">WhatsApp</div><div class="text-ivory" style="margin-top:6px"><?php echo esc_html( $whatsapp ); ?></div></div><?php endif; ?>
      <?php if ( $email ) : ?><div class="card-sacred"><div class="ss-section-eyebrow" data-hi="ईमेल" data-en="Email">ईमेल</div><div class="text-ivory" style="margin-top:6px"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="color:inherit"><?php echo esc_html( $email ); ?></a></div></div><?php endif; ?>
      <?php if ( $wa_digits ) : ?><a class="btn-primary-gold" style="justify-content:center" href="https://wa.me/<?php echo esc_attr( $wa_digits ); ?>" target="_blank" rel="noopener"><span data-hi="WhatsApp पर संपर्क करें" data-en="Contact on WhatsApp">WhatsApp पर संपर्क करें</span></a><?php endif; ?>
    </div>
  </div>
</section>
</main>
<style>@media(min-width:1024px){#contact-grid{grid-template-columns:1fr 1fr !important}}</style>
<!-- /wp:html -->
