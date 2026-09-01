<?php
/**
 * Plugin Name: Siddh Sannidham Core
 * Description: Custom post types (Aarti, Events, Bhandara, Seva, Gallery), settings (temple hours, live darshan, donation, contact) for the Siddh Sannidham theme. Content lives in the DB and survives theme changes.
 * Version: 1.0.0
 * Author: Siddh Sannidham
 * License: GPL-2.0-or-later
 * Text Domain: siddh-sannidham-core
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'SIDDH_CORE_VERSION', '1.0.0' );

/* ─────────── Register Custom Post Types ─────────── */
add_action( 'init', function () {
    $cpts = array(
        'ss_aarti' => array(
            'labels' => array( 'name' => 'Aartis', 'singular_name' => 'Aarti', 'add_new_item' => 'Add New Aarti' ),
            'menu_icon' => 'dashicons-buddicons-groups',
            'supports' => array( 'title' ),
        ),
        'ss_event' => array(
            'labels' => array( 'name' => 'Events', 'singular_name' => 'Event', 'add_new_item' => 'Add New Event' ),
            'menu_icon' => 'dashicons-calendar-alt',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'events' ),
        ),
        'ss_bhandara' => array(
            'labels' => array( 'name' => 'Bhandaras', 'singular_name' => 'Bhandara', 'add_new_item' => 'Add New Bhandara' ),
            'menu_icon' => 'dashicons-food',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'bhandara' ),
        ),
        'ss_seva' => array(
            'labels' => array( 'name' => 'Seva Options', 'singular_name' => 'Seva', 'add_new_item' => 'Add New Seva' ),
            'menu_icon' => 'dashicons-heart',
            'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
        ),
        'ss_gallery' => array(
            'labels' => array( 'name' => 'Gallery', 'singular_name' => 'Gallery Item', 'add_new_item' => 'Add New Image' ),
            'menu_icon' => 'dashicons-format-gallery',
            'supports' => array( 'title', 'thumbnail' ),
        ),
        'ss_contact' => array(
            'labels' => array( 'name' => 'Contact Messages', 'singular_name' => 'Contact Message' ),
            'menu_icon' => 'dashicons-email',
            'supports' => array( 'title', 'editor' ),
            'show_in_menu' => 'siddh_settings',
            'public' => false,
            'show_ui' => true,
            'capability_type' => 'post',
        ),
    );
    foreach ( $cpts as $slug => $args ) {
        $defaults = array(
            'public' => true,
            'show_in_rest' => true,
            'menu_position' => 26,
            'has_archive' => false,
        );
        register_post_type( $slug, array_merge( $defaults, $args ) );
    }

    // Journal categories with Hindi names
    if ( ! term_exists( 'shani-dev', 'category' ) ) {
        $cats = array( 'शनि देव', 'आध्यात्मिक ज्ञान', 'मंदिर परंपरा', 'भक्ति', 'सेवा', 'भंडारा', 'त्योहार', 'मंत्र', 'पूजन', 'मंदिर समाचार' );
        foreach ( $cats as $c ) { if ( ! term_exists( $c, 'category' ) ) wp_insert_term( $c, 'category' ); }
    }
} );

/* ─────────── Meta boxes ─────────── */
add_action( 'add_meta_boxes', function () {
    add_meta_box( 'ss_aarti_meta', 'Aarti Details', 'ss_render_aarti_meta', 'ss_aarti', 'normal', 'high' );
    add_meta_box( 'ss_event_meta', 'Event Details', 'ss_render_event_meta', 'ss_event', 'normal', 'high' );
    add_meta_box( 'ss_bhandara_meta', 'Bhandara Details', 'ss_render_bhandara_meta', 'ss_bhandara', 'normal', 'high' );
    add_meta_box( 'ss_seva_meta', 'Seva Details', 'ss_render_seva_meta', 'ss_seva', 'normal', 'high' );
} );

function ss_input_row( $label, $name, $value, $type = 'text', $post_id = 0 ) {
    printf(
        '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px;align-items:center;margin:8px 0"><label>%s</label><input type="%s" name="%s" value="%s" class="widefat"></p>',
        esc_html( $label ), esc_attr( $type ), esc_attr( $name ), esc_attr( $value )
    );
}

function ss_render_aarti_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Name', '_ss_aarti_name_hi', get_post_meta( $post->ID, '_ss_aarti_name_hi', true ) );
    ss_input_row( 'English Name', '_ss_aarti_name_en', get_post_meta( $post->ID, '_ss_aarti_name_en', true ) );
    ss_input_row( 'Time (24h, e.g. 07:15)', '_ss_aarti_time', get_post_meta( $post->ID, '_ss_aarti_time', true ) );
    ss_input_row( 'Days (comma-separated: monday,tuesday, or "daily")', '_ss_aarti_days', get_post_meta( $post->ID, '_ss_aarti_days', true ) );
    ss_input_row( 'Special Occasion', '_ss_aarti_occasion', get_post_meta( $post->ID, '_ss_aarti_occasion', true ) );
    ss_input_row( 'Video URL', '_ss_aarti_video', get_post_meta( $post->ID, '_ss_aarti_video', true ), 'url' );
    echo '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px"><label>Description</label><textarea name="_ss_aarti_desc" class="widefat" rows="3">' . esc_textarea( get_post_meta( $post->ID, '_ss_aarti_desc', true ) ) . '</textarea></p>';
}

function ss_render_event_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Title', '_ss_title_hi', get_post_meta( $post->ID, '_ss_title_hi', true ) );
    ss_input_row( 'English Title', '_ss_title_en', get_post_meta( $post->ID, '_ss_title_en', true ) );
    ss_input_row( 'Date', '_ss_event_date', get_post_meta( $post->ID, '_ss_event_date', true ), 'date' );
    ss_input_row( 'Time', '_ss_event_time', get_post_meta( $post->ID, '_ss_event_time', true ) );
    ss_input_row( 'Location', '_ss_event_location', get_post_meta( $post->ID, '_ss_event_location', true ) );
    ss_input_row( 'Category', '_ss_event_category', get_post_meta( $post->ID, '_ss_event_category', true ) );
    ss_input_row( 'Registration URL', '_ss_event_register_url', get_post_meta( $post->ID, '_ss_event_register_url', true ), 'url' );
    ss_input_row( 'Donation URL', '_ss_event_donate_url', get_post_meta( $post->ID, '_ss_event_donate_url', true ), 'url' );
    ss_input_row( 'Video URL', '_ss_event_video', get_post_meta( $post->ID, '_ss_event_video', true ), 'url' );
    echo '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px"><label>Hindi Description</label><textarea name="_ss_desc_hi" class="widefat" rows="3">' . esc_textarea( get_post_meta( $post->ID, '_ss_desc_hi', true ) ) . '</textarea></p>';
    echo '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px"><label>English Description</label><textarea name="_ss_desc_en" class="widefat" rows="3">' . esc_textarea( get_post_meta( $post->ID, '_ss_desc_en', true ) ) . '</textarea></p>';
}

function ss_render_bhandara_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Title', '_ss_title_hi', get_post_meta( $post->ID, '_ss_title_hi', true ) );
    ss_input_row( 'English Title', '_ss_title_en', get_post_meta( $post->ID, '_ss_title_en', true ) );
    ss_input_row( 'Date', '_ss_bhandara_date', get_post_meta( $post->ID, '_ss_bhandara_date', true ), 'date' );
    ss_input_row( 'Time', '_ss_bhandara_time', get_post_meta( $post->ID, '_ss_bhandara_time', true ) );
    ss_input_row( 'Location', '_ss_bhandara_location', get_post_meta( $post->ID, '_ss_bhandara_location', true ) );
    ss_input_row( 'Expected Devotees', '_ss_bhandara_devotees', get_post_meta( $post->ID, '_ss_bhandara_devotees', true ), 'number' );
    ss_input_row( 'Sponsorship Amount (₹)', '_ss_sponsor_amount', get_post_meta( $post->ID, '_ss_sponsor_amount', true ), 'number' );
    ss_input_row( 'Status', '_ss_bhandara_status', get_post_meta( $post->ID, '_ss_bhandara_status', true ) );
    echo '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px"><label>Hindi Description</label><textarea name="_ss_desc_hi" class="widefat" rows="3">' . esc_textarea( get_post_meta( $post->ID, '_ss_desc_hi', true ) ) . '</textarea></p>';
    echo '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px"><label>English Description</label><textarea name="_ss_desc_en" class="widefat" rows="3">' . esc_textarea( get_post_meta( $post->ID, '_ss_desc_en', true ) ) . '</textarea></p>';
}

function ss_render_seva_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Name', '_ss_name_hi', get_post_meta( $post->ID, '_ss_name_hi', true ) );
    ss_input_row( 'English Name', '_ss_name_en', get_post_meta( $post->ID, '_ss_name_en', true ) );
    ss_input_row( 'Amount (₹)', '_ss_amount', get_post_meta( $post->ID, '_ss_amount', true ), 'number' );
    ss_input_row( 'Category', '_ss_category', get_post_meta( $post->ID, '_ss_category', true ) );
    echo '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px"><label>Hindi Description</label><textarea name="_ss_desc_hi" class="widefat" rows="3">' . esc_textarea( get_post_meta( $post->ID, '_ss_desc_hi', true ) ) . '</textarea></p>';
    echo '<p style="display:grid;grid-template-columns:180px 1fr;gap:12px"><label>English Description</label><textarea name="_ss_desc_en" class="widefat" rows="3">' . esc_textarea( get_post_meta( $post->ID, '_ss_desc_en', true ) ) . '</textarea></p>';
}

add_action( 'save_post', function ( $post_id ) {
    if ( ! isset( $_POST['ss_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ss_meta_nonce'], 'ss_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    $fields = array(
        '_ss_aarti_name_hi','_ss_aarti_name_en','_ss_aarti_time','_ss_aarti_days','_ss_aarti_occasion','_ss_aarti_video','_ss_aarti_desc',
        '_ss_title_hi','_ss_title_en','_ss_event_date','_ss_event_time','_ss_event_location','_ss_event_category','_ss_event_register_url','_ss_event_donate_url','_ss_event_video',
        '_ss_desc_hi','_ss_desc_en',
        '_ss_bhandara_date','_ss_bhandara_time','_ss_bhandara_location','_ss_bhandara_devotees','_ss_sponsor_amount','_ss_bhandara_status',
        '_ss_name_hi','_ss_name_en','_ss_amount','_ss_category',
    );
    foreach ( $fields as $f ) {
        if ( isset( $_POST[ $f ] ) ) update_post_meta( $post_id, $f, sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) );
    }
} );

/* ─────────── Settings Page ─────────── */
add_action( 'admin_menu', function () {
    add_menu_page( 'Siddh Sannidham', 'Siddh Sannidham', 'manage_options', 'siddh_settings', 'ss_render_settings_page', 'dashicons-star-filled', 25 );
    add_submenu_page( 'siddh_settings', 'Settings', 'Settings', 'manage_options', 'siddh_settings', 'ss_render_settings_page' );
} );

add_action( 'admin_init', function () {
    register_setting( 'siddh_settings_group', 'siddh_settings', array( 'sanitize_callback' => 'ss_sanitize_settings' ) );
} );

function ss_sanitize_settings( $arr ) {
    $out = array();
    if ( ! is_array( $arr ) ) return $out;
    foreach ( $arr as $k => $v ) { $out[ sanitize_key( $k ) ] = is_string( $v ) ? sanitize_text_field( $v ) : $v; }
    return $out;
}

function ss_render_settings_page() {
    $opts = get_option( 'siddh_settings', array() );
    $groups = array(
        'Temple Info' => array(
            'phone' => 'Phone Number', 'whatsapp' => 'WhatsApp Number', 'email' => 'Email',
            'address_hi' => 'Address (Hindi)', 'address_en' => 'Address (English)',
            'maps_url' => 'Google Maps URL',
        ),
        'Temple Hours (24h format, Asia/Kolkata)' => array(
            'open_time' => 'Opening Time (HH:MM)', 'close_time' => 'Closing Time (HH:MM)',
        ),
        'Live Darshan' => array(
            'live_enabled' => 'Live enabled (1 or empty)',
            'live_channel_url' => 'YouTube Channel URL',
            'live_video_url' => 'Current Live Video URL',
        ),
        'Donation' => array(
            'upi_id' => 'UPI ID',
            'bank_holder' => 'Bank A/c Holder', 'bank_name' => 'Bank Name',
            'bank_account' => 'Account Number', 'bank_ifsc' => 'IFSC Code',
            'razorpay_key_id' => 'Razorpay Key ID (optional)',
            'razorpay_key_secret' => 'Razorpay Key Secret (optional)',
        ),
        'Social' => array(
            'youtube_url' => 'YouTube', 'instagram_url' => 'Instagram',
            'facebook_url' => 'Facebook', 'whatsapp_url' => 'WhatsApp Group URL',
        ),
        'Today at Temple' => array(
            'today_aarti' => "Today's Aarti", 'today_puja' => "Today's Puja",
            'today_bhandara' => "Today's Bhandara", 'today_special' => 'Special Event',
        ),
        'Darshan Timings' => array(
            'darshan_morning' => 'Morning', 'darshan_evening' => 'Afternoon/Evening', 'darshan_saturday' => 'Saturday Special',
        ),
        'Visit Info' => array(
            'nearest_airport_hi' => 'Nearest Airport (Hindi)', 'nearest_airport_en' => 'Nearest Airport (English)',
            'nearest_rail_hi' => 'Railway (Hindi)', 'nearest_rail_en' => 'Railway (English)',
            'nearest_bus_hi' => 'Bus (Hindi)', 'nearest_bus_en' => 'Bus (English)',
            'road_hi' => 'Road (Hindi)', 'road_en' => 'Road (English)',
        ),
        'Media' => array(
            'hero_image_url' => 'Hero Image URL', 'intro_image_url' => 'Intro Image URL',
        ),
    );
    echo '<div class="wrap"><h1>Siddh Sannidham — Settings</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields( 'siddh_settings_group' );
    foreach ( $groups as $group => $fields ) {
        echo '<h2 style="margin-top:32px">' . esc_html( $group ) . '</h2>';
        echo '<table class="form-table">';
        foreach ( $fields as $key => $label ) {
            $val = isset( $opts[ $key ] ) ? $opts[ $key ] : '';
            printf(
                '<tr><th><label for="%1$s">%2$s</label></th><td><input type="text" id="%1$s" name="siddh_settings[%1$s]" value="%3$s" class="regular-text"></td></tr>',
                esc_attr( $key ), esc_html( $label ), esc_attr( $val )
            );
        }
        echo '</table>';
    }
    submit_button( 'Save Settings' );
    echo '</form></div>';
}

/* ─────────── Donation intent handler (records only, does not process payment) ─────────── */
add_action( 'admin_post_nopriv_siddh_donation_intent', 'ss_donation_intent' );
add_action( 'admin_post_siddh_donation_intent', 'ss_donation_intent' );
function ss_donation_intent() {
    if ( ! isset( $_POST['siddh_nonce'] ) || ! wp_verify_nonce( $_POST['siddh_nonce'], 'siddh_donation' ) ) {
        wp_die( 'Invalid request' );
    }
    $amount = ! empty( $_POST['custom_amount'] ) ? (int) $_POST['custom_amount'] : (int) ( $_POST['amount'] ?? 0 );
    $data = array(
        'name' => sanitize_text_field( $_POST['name'] ?? '' ),
        'email' => sanitize_email( $_POST['email'] ?? '' ),
        'mobile' => sanitize_text_field( $_POST['mobile'] ?? '' ),
        'pan' => sanitize_text_field( $_POST['pan'] ?? '' ),
        'purpose' => sanitize_text_field( $_POST['purpose'] ?? '' ),
        'anonymous' => ! empty( $_POST['anonymous'] ),
        'amount' => $amount,
        'message' => sanitize_textarea_field( $_POST['message'] ?? '' ),
    );
    $post_id = wp_insert_post( array(
        'post_type' => 'ss_contact',
        'post_status' => 'private',
        'post_title' => 'Donation intent — ' . $data['name'] . ' ₹' . $amount,
        'post_content' => $data['message'],
        'meta_input' => array_map( 'wp_slash', $data ),
    ) );
    wp_safe_redirect( add_query_arg( 'donation_intent', $post_id ? 'ok' : 'error', wp_get_referer() ?: home_url( '/donate' ) ) );
    exit;
}
