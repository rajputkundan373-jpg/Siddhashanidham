<?php
/**
 * Siddh Sannidham Theme functions.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'siddh_setup' ) ) :
function siddh_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    load_theme_textdomain( 'siddh-sannidham', get_template_directory() . '/languages' );

    register_nav_menus( array(
        'primary'      => __( 'Primary Navigation', 'siddh-sannidham' ),
        'footer_quick' => __( 'Footer Quick Links', 'siddh-sannidham' ),
    ) );
}
endif;
add_action( 'after_setup_theme', 'siddh_setup' );

function siddh_enqueue() {
    wp_enqueue_style( 'siddh-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'siddh-app', get_template_directory_uri() . '/assets/js/app.js', array(), wp_get_theme()->get( 'Version' ), true );
    wp_localize_script( 'siddh-app', 'SSData', array(
        'homeUrl'    => home_url( '/' ),
        'restUrl'    => esc_url_raw( rest_url() ),
        'timezone'   => 'Asia/Kolkata',
        'templeHours'=> siddh_temple_hours(),
        'liveDarshan'=> siddh_live_darshan(),
    ) );
}
add_action( 'wp_enqueue_scripts', 'siddh_enqueue' );

/* ───── Header/Footer Shortcodes (bulletproof rendering — works in every WP block-theme + caching setup) ───── */
function siddh_render_header_shortcode() {
    ob_start();
    $file = get_template_directory() . '/patterns/site-header.php';
    if ( file_exists( $file ) ) {
        $args = array(); // pattern files may expect $args
        include $file;
    }
    return ob_get_clean();
}
add_shortcode( 'siddh_header', 'siddh_render_header_shortcode' );

function siddh_render_footer_shortcode() {
    ob_start();
    $file = get_template_directory() . '/patterns/site-footer.php';
    if ( file_exists( $file ) ) {
        $args = array();
        include $file;
    }
    return ob_get_clean();
}
add_shortcode( 'siddh_footer', 'siddh_render_footer_shortcode' );

/* ─── Contact form shortcode (settings-driven info) ─── */
function siddh_render_contact_form_shortcode() {
    $phone      = siddh_get_option( 'phone', '' );
    $whatsapp   = siddh_get_option( 'whatsapp', '' );
    $email      = siddh_get_option( 'email', '' );
    $address_hi = siddh_get_option( 'address_hi', 'इटावा-ग्वालियर मार्ग, मध्य प्रदेश, भारत' );
    $address_en = siddh_get_option( 'address_en', 'Etawa–Gwalior Road, Madhya Pradesh, India' );
    $wa_digits  = preg_replace( '/\D/', '', $whatsapp );
    ob_start(); ?>
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
          <div class="card-sacred">
            <div class="ss-section-eyebrow" data-hi="पता" data-en="Address">पता</div>
            <div class="text-ivory" style="margin-top:6px"><span data-hi="<?php echo esc_attr( $address_hi ); ?>" data-en="<?php echo esc_attr( $address_en ); ?>"><?php echo esc_html( $address_hi ); ?></span></div>
          </div>
          <?php if ( $phone ) : ?><div class="card-sacred"><div class="ss-section-eyebrow" data-hi="फ़ोन" data-en="Phone">फ़ोन</div><div class="text-ivory" style="margin-top:6px"><a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" style="color:inherit"><?php echo esc_html( $phone ); ?></a></div></div><?php endif; ?>
          <?php if ( $whatsapp ) : ?><div class="card-sacred"><div class="ss-section-eyebrow">WhatsApp</div><div class="text-ivory" style="margin-top:6px"><?php echo esc_html( $whatsapp ); ?></div></div><?php endif; ?>
          <?php if ( $email ) : ?><div class="card-sacred"><div class="ss-section-eyebrow" data-hi="ईमेल" data-en="Email">ईमेल</div><div class="text-ivory" style="margin-top:6px"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="color:inherit"><?php echo esc_html( $email ); ?></a></div></div><?php endif; ?>
          <?php if ( $wa_digits ) : ?><a class="btn-primary-gold" style="justify-content:center" href="https://wa.me/<?php echo esc_attr( $wa_digits ); ?>" target="_blank" rel="noopener"><span data-hi="WhatsApp पर संपर्क करें" data-en="Contact on WhatsApp">WhatsApp पर संपर्क करें</span></a><?php endif; ?>
        </div>
      </div>
    </section>
    <style>@media(min-width:1024px){#contact-grid{grid-template-columns:1fr 1fr !important}}</style>
    <?php return ob_get_clean();
}
add_shortcode( 'siddh_contact_form', 'siddh_render_contact_form_shortcode' );

/* ─── Donate page shortcode (settings-driven UPI/bank/tiers + Razorpay-ready) ─── */
function siddh_render_donate_page_shortcode() {
    $upi          = siddh_get_option( 'upi_id', 'siddhsannidham@upi' );
    $bank_name    = siddh_get_option( 'bank_name', '' );
    $bank_holder  = siddh_get_option( 'bank_holder', '' );
    $bank_account = siddh_get_option( 'bank_account', '' );
    $bank_ifsc    = siddh_get_option( 'bank_ifsc', '' );
    $rp_key       = siddh_get_option( 'razorpay_key_id', '' );
    $tiers        = function_exists( 'siddh_donation_tiers' ) ? siddh_donation_tiers() : array( 501, 1001, 2501, 5001, 11001 );
    $purposes     = array( 'सामान्य मंदिर सेवा' => 'General Temple Seva', 'भंडारा सेवा' => 'Bhandara Seva', 'अन्नदान' => 'Annadan', 'विशेष पूजा' => 'Special Puja', 'मंदिर विकास' => 'Temple Development', 'अन्य सेवा' => 'Other Seva' );
    ob_start(); ?>
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
          <?php if ( $rp_key ) : ?>
            <p style="font-size:12px;color:#B0B7C3;margin-top:16px" data-hi="Razorpay भुगतान गेटवे शीघ्र सक्रिय होगा।" data-en="Razorpay payment gateway will be activated shortly.">Razorpay भुगतान गेटवे शीघ्र सक्रिय होगा।</p>
          <?php else : ?>
            <p style="font-size:12px;color:#B0B7C3;margin-top:16px" data-hi="भुगतान गेटवे शीघ्र सक्रिय किया जाएगा। तब तक कृपया नीचे दिए UPI/बैंक विवरण का उपयोग करें।" data-en="Payment gateway is coming soon. Meanwhile, please use the UPI / bank details below.">भुगतान गेटवे शीघ्र सक्रिय किया जाएगा। तब तक कृपया नीचे दिए UPI/बैंक विवरण का उपयोग करें।</p>
          <?php endif; ?>
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
    <style>@media(min-width:1024px){#donate-grid{grid-template-columns:2fr 1fr !important}}</style>
    <?php return ob_get_clean();
}
add_shortcode( 'siddh_donate_page', 'siddh_render_donate_page_shortcode' );

/* ───── Block Styles ───── */
function siddh_register_block_styles() {
    register_block_style( 'core/button', array( 'name' => 'gold-primary', 'label' => __( 'Gold Primary', 'siddh-sannidham' ) ) );
    register_block_style( 'core/button', array( 'name' => 'gold-outline', 'label' => __( 'Gold Outline', 'siddh-sannidham' ) ) );
    register_block_style( 'core/group', array( 'name' => 'card-sacred', 'label' => __( 'Sacred Card', 'siddh-sannidham' ) ) );
}
add_action( 'init', 'siddh_register_block_styles' );

/* ───── Block Pattern Category ───── */
function siddh_register_pattern_category() {
    if ( function_exists( 'register_block_pattern_category' ) ) {
        register_block_pattern_category( 'siddh-sannidham', array( 'label' => __( 'Siddh Sannidham', 'siddh-sannidham' ) ) );
    }
}
add_action( 'init', 'siddh_register_pattern_category' );

/* ───── Temple Settings (safe getters — companion plugin manages the UI) ───── */
function siddh_get_option( $key, $default = '' ) {
    $opts = get_option( 'siddh_settings', array() );
    return isset( $opts[ $key ] ) && $opts[ $key ] !== '' ? $opts[ $key ] : $default;
}

function siddh_temple_hours() {
    return array(
        'open'  => siddh_get_option( 'open_time', '05:00' ),
        'close' => siddh_get_option( 'close_time', '21:30' ),
        'timezone' => 'Asia/Kolkata',
    );
}

function siddh_is_temple_open() {
    $override = siddh_get_option( 'status_override', '' );
    if ( $override === 'open' ) return true;
    if ( $override === 'closed' ) return false;
    $tz = new DateTimeZone( 'Asia/Kolkata' );
    $now = new DateTime( 'now', $tz );
    $h = siddh_temple_hours();
    $open  = DateTime::createFromFormat( 'H:i', $h['open'], $tz );
    $close = DateTime::createFromFormat( 'H:i', $h['close'], $tz );
    if ( ! $open || ! $close ) return null;
    $open->setDate( (int)$now->format('Y'), (int)$now->format('m'), (int)$now->format('d') );
    $close->setDate( (int)$now->format('Y'), (int)$now->format('m'), (int)$now->format('d') );
    return ( $now >= $open && $now <= $close );
}

function siddh_donation_tiers() {
    $defaults = array( 501, 1001, 2501, 5001, 11001 );
    $out = array();
    for ( $i = 1; $i <= 5; $i++ ) {
        $v = (int) siddh_get_option( 'donation_tier_' . $i, $defaults[ $i - 1 ] );
        if ( $v > 0 ) $out[] = $v;
    }
    return $out ?: $defaults;
}

function siddh_live_darshan() {
    return array(
        'channel_url' => siddh_get_option( 'live_channel_url', '' ),
        'live_url'    => siddh_get_option( 'live_video_url', '' ),
        'is_live'     => (bool) siddh_get_option( 'live_enabled', false ),
    );
}

/* ───── Format date in Indian human-readable style ───── */
function siddh_format_date( $iso ) {
    if ( ! $iso ) return '';
    try { $d = new DateTime( $iso, new DateTimeZone( 'Asia/Kolkata' ) ); return $d->format( 'j F Y' ); }
    catch ( Exception $e ) { return esc_html( $iso ); }
}

/* ───── Aarti helpers (uses CPT registered by companion plugin) ───── */
function siddh_get_todays_aartis() {
    if ( ! post_type_exists( 'ss_aarti' ) ) return array();
    $today_dow = strtolower( wp_date( 'l', null, new DateTimeZone( 'Asia/Kolkata' ) ) );
    $q = new WP_Query( array(
        'post_type'      => 'ss_aarti',
        'posts_per_page' => -1,
        'orderby'        => 'meta_value',
        'meta_key'       => '_ss_aarti_time',
        'order'          => 'ASC',
    ) );
    $out = array();
    foreach ( $q->posts as $p ) {
        $days = get_post_meta( $p->ID, '_ss_aarti_days', true ); // comma-separated
        $days = $days ? array_map( 'strtolower', array_map( 'trim', explode( ',', $days ) ) ) : array();
        if ( empty( $days ) || in_array( $today_dow, $days, true ) || in_array( 'daily', $days, true ) ) {
            $out[] = array(
                'id'      => $p->ID,
                'name_en' => get_post_meta( $p->ID, '_ss_aarti_name_en', true ) ?: $p->post_title,
                'name_hi' => get_post_meta( $p->ID, '_ss_aarti_name_hi', true ) ?: $p->post_title,
                'time'    => get_post_meta( $p->ID, '_ss_aarti_time', true ),
                'video'   => get_post_meta( $p->ID, '_ss_aarti_video', true ),
            );
        }
    }
    return $out;
}

function siddh_next_aarti() {
    $aartis = siddh_get_todays_aartis();
    if ( empty( $aartis ) ) return null;
    $tz  = new DateTimeZone( 'Asia/Kolkata' );
    $now = new DateTime( 'now', $tz );
    foreach ( $aartis as $a ) {
        $t = DateTime::createFromFormat( 'H:i', $a['time'], $tz );
        if ( $t ) {
            $t->setDate( (int)$now->format('Y'), (int)$now->format('m'), (int)$now->format('d') );
            if ( $t > $now ) return $a;
        }
    }
    return null;
}

/* ───── Simple contact & newsletter capture (REST) ───── */
add_action( 'rest_api_init', function () {
    register_rest_route( 'siddh/v1', '/contact', array(
        'methods'  => 'POST',
        'callback' => 'siddh_contact_submit',
        'permission_callback' => '__return_true',
    ) );
    register_rest_route( 'siddh/v1', '/newsletter', array(
        'methods'  => 'POST',
        'callback' => 'siddh_newsletter_submit',
        'permission_callback' => '__return_true',
    ) );
} );

function siddh_contact_submit( WP_REST_Request $r ) {
    $name    = sanitize_text_field( $r->get_param( 'name' ) );
    $email   = sanitize_email( $r->get_param( 'email' ) );
    $mobile  = sanitize_text_field( $r->get_param( 'mobile' ) );
    $message = sanitize_textarea_field( $r->get_param( 'message' ) );
    if ( ! $name || ! $email || ! $message ) return new WP_Error( 'invalid', 'Missing fields', array( 'status' => 400 ) );
    $id = wp_insert_post( array(
        'post_type'   => 'ss_contact',
        'post_status' => 'private',
        'post_title'  => $name . ' — ' . current_time( 'mysql' ),
        'post_content'=> $message,
        'meta_input'  => array( '_email' => $email, '_mobile' => $mobile ),
    ) );
    return array( 'ok' => (bool) $id );
}

function siddh_newsletter_submit( WP_REST_Request $r ) {
    $email = sanitize_email( $r->get_param( 'email' ) );
    if ( ! $email ) return new WP_Error( 'invalid', 'Invalid email', array( 'status' => 400 ) );
    $list = get_option( 'siddh_newsletter', array() );
    if ( ! in_array( $email, $list, true ) ) { $list[] = $email; update_option( 'siddh_newsletter', $list ); }
    return array( 'ok' => true );
}

/* ───── Body class flags ───── */
add_filter( 'body_class', function ( $c ) {
    $c[] = 'siddh-theme';
    $lang = isset( $_COOKIE['ss_lang'] ) && $_COOKIE['ss_lang'] === 'en' ? 'en' : 'hi';
    $c[] = 'lang-' . $lang;
    return $c;
} );

/* ───── Safe fallback nav menu ───── */
function siddh_default_menu_items() {
    return array(
        array( '/', 'मुख्य', 'Home' ),
        array( '/about', 'परिचय', 'About' ),
        array( '/shani-dev', 'शनि देव', 'Shani Dev' ),
        array( '/darshan', 'दर्शन', 'Darshan' ),
        array( '/seva', 'सेवा', 'Seva' ),
        array( '/bhandara', 'भंडारा', 'Bhandara' ),
        array( '/live-aarti', 'लाइव आरती', 'Live Aarti' ),
        array( '/events', 'आयोजन', 'Events' ),
        array( '/journal', 'जर्नल', 'Journal' ),
        array( '/gallery', 'गैलरी', 'Gallery' ),
        array( '/visit-us', 'यात्रा', 'Visit Us' ),
        array( '/contact', 'संपर्क', 'Contact' ),
    );
}
