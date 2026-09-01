<?php
/**
 * Title: Donate Page
 * Slug: siddh-sannidham/donate-page
 * Categories: siddh-sannidham
 */
$upi   = siddh_get_option( 'upi_id', 'siddhsannidham@upi' );
$bank_name    = siddh_get_option( 'bank_name', '' );
$bank_holder  = siddh_get_option( 'bank_holder', '' );
$bank_account = siddh_get_option( 'bank_account', '' );
$bank_ifsc    = siddh_get_option( 'bank_ifsc', '' );
$tiers = function_exists( 'siddh_donation_tiers' ) ? siddh_donation_tiers() : array( 501, 1001, 2501, 5001, 11001 );
$purposes = array( 'सामान्य मंदिर सेवा' => 'General Temple Seva', 'भंडारा सेवा' => 'Bhandara Seva', 'अन्नदान' => 'Annadan', 'विशेष पूजा' => 'Special Puja', 'मंदिर विकास' => 'Temple Development', 'अन्य सेवा' => 'Other Seva' );
?>
<!-- wp:html -->
<main>
<section style="min-height:45vh;position:relative;overflow:hidden;padding:96px 24px 48px">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1800&q=85" style="width:100%;height:100%;object-fit:cover;opacity:.5" alt=""></div>
  <div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div>
  <div class="ss-container" style="position:relative">
    <div class="ss-section-eyebrow">DONATE</div>
    <h1 class="hi" style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,3.5rem);color:#F6F4EE;margin:0">आपकी श्रद्धा, हमारी सेवा</h1>
    <div class="gold-underline" style="margin-top:20px"></div>
    <p class="text-muted-ivory" style="margin-top:20px;max-width:640px" data-hi="मंदिर, भंडारा एवं सेवा कार्यों में अपना योगदान दें।" data-en="Contribute to the temple, bhandara and seva activities.">मंदिर, भंडारा एवं सेवा कार्यों में अपना योगदान दें।</p>
  </div>
</section>

<section class="ss-section">
  <div class="ss-container" style="display:grid;grid-template-columns:1fr;gap:40px" id="donate-grid">
    <form data-ss-form="contact" class="card-sacred" id="ss-donate-form" style="padding:32px" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
      <input type="hidden" name="action" value="siddh_donation_intent">
      <?php wp_nonce_field( 'siddh_donation', 'siddh_nonce' ); ?>
      <h3 class="hi" style="font-family:'Rozha One',serif;color:#F6F4EE;font-size:24px;margin:0 0 24px" data-hi="दान का उद्देश्य" data-en="Purpose of Donation">दान का उद्देश्य</h3>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:32px">
        <?php foreach ( $purposes as $hi => $en ) : ?>
          <label style="text-align:left;padding:12px 16px;border:1px solid rgba(212,175,55,.22);border-radius:8px;cursor:pointer;font-size:14px;color:rgba(246,244,238,.85);display:flex;gap:10px;align-items:center">
            <input type="radio" name="purpose" value="<?php echo esc_attr( $en ); ?>" required>
            <span data-hi="<?php echo esc_attr( $hi ); ?>" data-en="<?php echo esc_attr( $en ); ?>"><?php echo esc_html( $hi ); ?></span>
          </label>
        <?php endforeach; ?>
      </div>
      <h3 class="hi" style="font-family:'Rozha One',serif;color:#F6F4EE;font-size:24px;margin:0 0 24px" data-hi="राशि" data-en="Amount">राशि</h3>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:16px" class="ss-tiers">
        <?php foreach ( $tiers as $t ) : ?>
          <label style="padding:12px;border:1px solid rgba(212,175,55,.22);border-radius:999px;text-align:center;cursor:pointer;font-family:'Cinzel',serif">
            <input type="radio" name="amount" value="<?php echo esc_attr( $t ); ?>" style="display:none">
            ₹<?php echo esc_html( number_format( $t ) ); ?>
          </label>
        <?php endforeach; ?>
      </div>
      <input type="number" min="1" name="custom_amount" placeholder="अन्य राशि दर्ज करें / Custom amount" class="ss-input" style="margin-bottom:24px">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
        <input class="ss-input" name="name" required placeholder="नाम / Name">
        <input class="ss-input" type="email" name="email" required placeholder="ईमेल / Email">
        <input class="ss-input" name="mobile" required placeholder="मोबाइल / Mobile">
        <input class="ss-input" name="pan" placeholder="PAN (वैकल्पिक)">
      </div>
      <textarea class="ss-textarea" name="message" rows="3" placeholder="संदेश (वैकल्पिक) / Message (optional)" style="margin-top:16px"></textarea>
      <label style="display:flex;align-items:center;gap:12px;margin-top:16px;font-size:14px;color:#B0B7C3"><input type="checkbox" name="anonymous" value="1"> <span data-hi="गुप्त दान (नाम प्रकट न करें)" data-en="Anonymous donation">गुप्त दान (नाम प्रकट न करें)</span></label>
      <button type="submit" class="btn-primary-gold" style="margin-top:24px;width:100%;justify-content:center"><span data-hi="दान संकल्प" data-en="Confirm Donation">दान संकल्प</span></button>
      <p style="font-size:12px;color:#B0B7C3;margin-top:16px" data-hi="भुगतान गेटवे शीघ्र सक्रिय किया जाएगा। तब तक कृपया नीचे दिए UPI/बैंक विवरण का उपयोग करें।" data-en="Payment gateway is coming soon. Meanwhile, please use the UPI / bank details below.">भुगतान गेटवे शीघ्र सक्रिय किया जाएगा। तब तक कृपया नीचे दिए UPI/बैंक विवरण का उपयोग करें।</p>
    </form>

    <aside style="display:flex;flex-direction:column;gap:24px">
      <div class="card-sacred">
        <div class="ss-section-eyebrow" style="margin-bottom:12px">UPI</div>
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px"><span class="text-ivory" style="font-family:'Cinzel',serif;word-break:break-all"><?php echo esc_html( $upi ); ?></span></div>
        <div style="margin-top:20px;aspect-ratio:1/1;border:1px solid rgba(212,175,55,.22);border-radius:8px;display:flex;align-items:center;justify-content:center;background:#0B0C10;overflow:hidden"><img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo esc_attr( rawurlencode( 'upi://pay?pa=' . $upi . '&pn=Siddh+Sannidham' ) ); ?>&size=300x300&bgcolor=0B0C10&color=D4AF37" alt="UPI QR" style="width:60%"></div>
      </div>
      <?php if ( $bank_holder ) : ?>
      <div class="card-sacred">
        <div class="ss-section-eyebrow" style="margin-bottom:12px" data-hi="बैंक विवरण" data-en="Bank Details">बैंक विवरण</div>
        <ul style="list-style:none;padding:0;margin:0;font-size:14px;color:rgba(246,244,238,.85)">
          <li><span class="text-muted-ivory">A/c:</span> <?php echo esc_html( $bank_holder ); ?></li>
          <li><span class="text-muted-ivory">Bank:</span> <?php echo esc_html( $bank_name ); ?></li>
          <li><span class="text-muted-ivory">A/c No.:</span> <?php echo esc_html( $bank_account ); ?></li>
          <li><span class="text-muted-ivory">IFSC:</span> <?php echo esc_html( $bank_ifsc ); ?></li>
        </ul>
      </div>
      <?php endif; ?>
      <div class="card-sacred">
        <div class="ss-section-eyebrow" style="margin-bottom:12px" data-hi="कहाँ जाता है योगदान" data-en="Where Your Contribution Goes">कहाँ जाता है योगदान</div>
        <ul style="list-style:none;padding:0;margin:0;font-size:14px;color:rgba(246,244,238,.85);line-height:2">
          <li>• <span data-hi="मंदिर संचालन एवं रखरखाव" data-en="Temple operations & upkeep">मंदिर संचालन एवं रखरखाव</span></li>
          <li>• <span data-hi="भंडारा एवं अन्नदान" data-en="Bhandara & annadan">भंडारा एवं अन्नदान</span></li>
          <li>• <span data-hi="गौ सेवा" data-en="Gau seva">गौ सेवा</span></li>
          <li>• <span data-hi="जरूरतमंद सहायता" data-en="Support for the needy">जरूरतमंद सहायता</span></li>
        </ul>
      </div>
    </aside>
  </div>
</section>
</main>
<style>@media(min-width:1024px){#donate-grid{grid-template-columns:2fr 1fr !important}}</style>
<!-- /wp:html -->
