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
