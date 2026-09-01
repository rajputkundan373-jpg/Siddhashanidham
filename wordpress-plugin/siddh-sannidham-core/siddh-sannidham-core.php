<?php
/**
 * Plugin Name: Siddh Sannidham Core
 * Description: Custom post types (Aarti, Events, Bhandara, Seva, Gallery, Testimonials), temple settings, page auto-creation, and donation intent capture for the Siddh Sannidham WordPress theme. Content lives in the DB and survives theme changes.
 * Version: 1.1.0
 * Author: Siddh Sannidham
 * License: GPL-2.0-or-later
 * Text Domain: siddh-sannidham-core
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'SIDDH_CORE_VERSION', '1.1.0' );

/* ─────────── Register Custom Post Types ─────────── */
add_action( 'init', function () {
    $cpts = array(
        'ss_aarti' => array(
            'labels' => array( 'name' => 'Aartis', 'singular_name' => 'Aarti', 'add_new_item' => 'Add New Aarti', 'menu_name' => 'Aartis' ),
            'menu_icon' => 'dashicons-buddicons-groups',
            'supports' => array( 'title' ),
        ),
        'ss_event' => array(
            'labels' => array( 'name' => 'Events', 'singular_name' => 'Event', 'add_new_item' => 'Add New Event', 'menu_name' => 'Events' ),
            'menu_icon' => 'dashicons-calendar-alt',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'has_archive' => 'events-archive',
            'rewrite' => array( 'slug' => 'event' ),
        ),
        'ss_bhandara' => array(
            'labels' => array( 'name' => 'Bhandaras', 'singular_name' => 'Bhandara', 'add_new_item' => 'Add New Bhandara', 'menu_name' => 'Bhandaras' ),
            'menu_icon' => 'dashicons-food',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'has_archive' => 'bhandara-archive',
            'rewrite' => array( 'slug' => 'bhandara-item' ),
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
        'ss_testimonial' => array(
            'labels' => array( 'name' => 'Devotee Experiences', 'singular_name' => 'Experience', 'add_new_item' => 'Add New Experience' ),
            'menu_icon' => 'dashicons-format-quote',
            'supports' => array( 'title', 'editor' ),
        ),
        'ss_contact' => array(
            'labels' => array( 'name' => 'Contact / Donation Intents' ),
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
    add_meta_box( 'ss_test_meta', 'Experience Details', 'ss_render_testimonial_meta', 'ss_testimonial', 'normal', 'high' );
} );

function ss_input_row( $label, $name, $value, $type = 'text' ) {
    printf(
        '<p style="display:grid;grid-template-columns:220px 1fr;gap:12px;align-items:center;margin:8px 0"><label>%s</label><input type="%s" name="%s" value="%s" class="widefat"></p>',
        esc_html( $label ), esc_attr( $type ), esc_attr( $name ), esc_attr( $value )
    );
}
function ss_textarea_row( $label, $name, $value, $rows = 3 ) {
    printf(
        '<p style="display:grid;grid-template-columns:220px 1fr;gap:12px"><label>%s</label><textarea name="%s" class="widefat" rows="%d">%s</textarea></p>',
        esc_html( $label ), esc_attr( $name ), (int) $rows, esc_textarea( $value )
    );
}

function ss_render_aarti_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Name (e.g. संध्या आरती)', '_ss_aarti_name_hi', get_post_meta( $post->ID, '_ss_aarti_name_hi', true ) );
    ss_input_row( 'English Name', '_ss_aarti_name_en', get_post_meta( $post->ID, '_ss_aarti_name_en', true ) );
    ss_input_row( 'Time (24h HH:MM)', '_ss_aarti_time', get_post_meta( $post->ID, '_ss_aarti_time', true ) );
    ss_input_row( 'Days (daily OR monday,tuesday,saturday)', '_ss_aarti_days', get_post_meta( $post->ID, '_ss_aarti_days', true ) );
    ss_input_row( 'Special Occasion (optional)', '_ss_aarti_occasion', get_post_meta( $post->ID, '_ss_aarti_occasion', true ) );
    ss_input_row( 'Video URL (optional)', '_ss_aarti_video', get_post_meta( $post->ID, '_ss_aarti_video', true ), 'url' );
    ss_textarea_row( 'Description', '_ss_aarti_desc', get_post_meta( $post->ID, '_ss_aarti_desc', true ) );
    ss_input_row( 'Active (1 or empty)', '_ss_aarti_active', get_post_meta( $post->ID, '_ss_aarti_active', true ) );
}
function ss_render_event_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Title', '_ss_title_hi', get_post_meta( $post->ID, '_ss_title_hi', true ) );
    ss_input_row( 'English Title', '_ss_title_en', get_post_meta( $post->ID, '_ss_title_en', true ) );
    ss_input_row( 'Date (YYYY-MM-DD)', '_ss_event_date', get_post_meta( $post->ID, '_ss_event_date', true ), 'date' );
    ss_input_row( 'Time', '_ss_event_time', get_post_meta( $post->ID, '_ss_event_time', true ) );
    ss_input_row( 'Location', '_ss_event_location', get_post_meta( $post->ID, '_ss_event_location', true ) );
    ss_input_row( 'Category', '_ss_event_category', get_post_meta( $post->ID, '_ss_event_category', true ) );
    ss_input_row( 'Registration URL', '_ss_event_register_url', get_post_meta( $post->ID, '_ss_event_register_url', true ), 'url' );
    ss_input_row( 'Donation URL', '_ss_event_donate_url', get_post_meta( $post->ID, '_ss_event_donate_url', true ), 'url' );
    ss_input_row( 'Video URL', '_ss_event_video', get_post_meta( $post->ID, '_ss_event_video', true ), 'url' );
    ss_textarea_row( 'Hindi Description', '_ss_desc_hi', get_post_meta( $post->ID, '_ss_desc_hi', true ) );
    ss_textarea_row( 'English Description', '_ss_desc_en', get_post_meta( $post->ID, '_ss_desc_en', true ) );
}
function ss_render_bhandara_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Title', '_ss_title_hi', get_post_meta( $post->ID, '_ss_title_hi', true ) );
    ss_input_row( 'English Title', '_ss_title_en', get_post_meta( $post->ID, '_ss_title_en', true ) );
    ss_input_row( 'Date (YYYY-MM-DD)', '_ss_bhandara_date', get_post_meta( $post->ID, '_ss_bhandara_date', true ), 'date' );
    ss_input_row( 'Time', '_ss_bhandara_time', get_post_meta( $post->ID, '_ss_bhandara_time', true ) );
    ss_input_row( 'Location', '_ss_bhandara_location', get_post_meta( $post->ID, '_ss_bhandara_location', true ) );
    ss_input_row( 'Expected Devotees', '_ss_bhandara_devotees', get_post_meta( $post->ID, '_ss_bhandara_devotees', true ), 'number' );
    ss_input_row( 'Sponsorship Amount (₹)', '_ss_sponsor_amount', get_post_meta( $post->ID, '_ss_sponsor_amount', true ), 'number' );
    ss_input_row( 'Status (upcoming/past)', '_ss_bhandara_status', get_post_meta( $post->ID, '_ss_bhandara_status', true ) );
    ss_textarea_row( 'Hindi Description', '_ss_desc_hi', get_post_meta( $post->ID, '_ss_desc_hi', true ) );
    ss_textarea_row( 'English Description', '_ss_desc_en', get_post_meta( $post->ID, '_ss_desc_en', true ) );
}
function ss_render_seva_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'Hindi Name', '_ss_name_hi', get_post_meta( $post->ID, '_ss_name_hi', true ) );
    ss_input_row( 'English Name', '_ss_name_en', get_post_meta( $post->ID, '_ss_name_en', true ) );
    ss_input_row( 'Suggested Amount (₹)', '_ss_amount', get_post_meta( $post->ID, '_ss_amount', true ), 'number' );
    ss_input_row( 'Category', '_ss_category', get_post_meta( $post->ID, '_ss_category', true ) );
    ss_input_row( 'Active (1 or empty)', '_ss_seva_active', get_post_meta( $post->ID, '_ss_seva_active', true ) );
    ss_textarea_row( 'Hindi Description', '_ss_desc_hi', get_post_meta( $post->ID, '_ss_desc_hi', true ) );
    ss_textarea_row( 'English Description', '_ss_desc_en', get_post_meta( $post->ID, '_ss_desc_en', true ) );
}
function ss_render_testimonial_meta( $post ) {
    wp_nonce_field( 'ss_meta', 'ss_meta_nonce' );
    ss_input_row( 'City', '_ss_city', get_post_meta( $post->ID, '_ss_city', true ) );
    ss_input_row( 'Verified (1 or empty)', '_ss_verified', get_post_meta( $post->ID, '_ss_verified', true ) );
    ss_textarea_row( 'Experience (Hindi)', '_ss_experience_hi', get_post_meta( $post->ID, '_ss_experience_hi', true ) );
    ss_textarea_row( 'Experience (English)', '_ss_experience_en', get_post_meta( $post->ID, '_ss_experience_en', true ) );
}

add_action( 'save_post', function ( $post_id ) {
    if ( ! isset( $_POST['ss_meta_nonce'] ) || ! wp_verify_nonce( $_POST['ss_meta_nonce'], 'ss_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    $fields = array(
        '_ss_aarti_name_hi','_ss_aarti_name_en','_ss_aarti_time','_ss_aarti_days','_ss_aarti_occasion','_ss_aarti_video','_ss_aarti_desc','_ss_aarti_active',
        '_ss_title_hi','_ss_title_en','_ss_event_date','_ss_event_time','_ss_event_location','_ss_event_category','_ss_event_register_url','_ss_event_donate_url','_ss_event_video',
        '_ss_desc_hi','_ss_desc_en',
        '_ss_bhandara_date','_ss_bhandara_time','_ss_bhandara_location','_ss_bhandara_devotees','_ss_sponsor_amount','_ss_bhandara_status',
        '_ss_name_hi','_ss_name_en','_ss_amount','_ss_category','_ss_seva_active',
        '_ss_city','_ss_verified','_ss_experience_hi','_ss_experience_en',
    );
    foreach ( $fields as $f ) {
        if ( isset( $_POST[ $f ] ) ) update_post_meta( $post_id, $f, sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) );
    }
} );

/* ─────────── Settings Page ─────────── */
add_action( 'admin_menu', function () {
    add_menu_page( 'Siddh Sannidham', 'Siddh Sannidham', 'manage_options', 'siddh_settings', 'ss_render_settings_page', 'dashicons-star-filled', 25 );
    add_submenu_page( 'siddh_settings', 'Settings', 'Settings', 'manage_options', 'siddh_settings', 'ss_render_settings_page' );
    add_submenu_page( 'siddh_settings', 'Setup Pages', 'Setup Pages', 'manage_options', 'siddh_setup_pages', 'ss_setup_pages_screen' );
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
            'status_override' => 'Manual Status Override (open / closed / empty for auto)',
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
            'donation_tier_1' => 'Tier 1 (default 501)', 'donation_tier_2' => 'Tier 2 (default 1001)',
            'donation_tier_3' => 'Tier 3 (default 2501)', 'donation_tier_4' => 'Tier 4 (default 5001)',
            'donation_tier_5' => 'Tier 5 (default 11001)',
            'razorpay_key_id' => 'Razorpay Key ID (optional)',
            'razorpay_key_secret' => 'Razorpay Key Secret (optional)',
        ),
        'Social' => array(
            'youtube_url' => 'YouTube', 'instagram_url' => 'Instagram',
            'facebook_url' => 'Facebook', 'whatsapp_url' => 'WhatsApp',
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
        'Media (URLs — leave empty to use theme defaults)' => array(
            'hero_image_url' => 'Hero Image URL', 'intro_image_url' => 'Intro Image URL',
        ),
    );
    echo '<div class="wrap"><h1>Siddh Sannidham — Settings</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields( 'siddh_settings_group' );
    foreach ( $groups as $group => $fields ) {
        echo '<h2 style="margin-top:32px">' . esc_html( $group ) . '</h2><table class="form-table">';
        foreach ( $fields as $key => $label ) {
            $val = isset( $opts[ $key ] ) ? $opts[ $key ] : '';
            printf( '<tr><th><label for="%1$s">%2$s</label></th><td><input type="text" id="%1$s" name="siddh_settings[%1$s]" value="%3$s" class="regular-text"></td></tr>', esc_attr( $key ), esc_html( $label ), esc_attr( $val ) );
        }
        echo '</table>';
    }
    submit_button( 'Save Settings' );
    echo '</form></div>';
}

/* ─────────── Auto page creation ─────────── */
function ss_pages_config() {
    return array(
        // slug => [title_hi, title_en, template_slug]
        'about'        => array( 'सिद्ध सन्निधम् के विषय में', 'About Siddh Sannidham', 'page-about' ),
        'shani-dev'    => array( 'शनि देव', 'Shani Dev', 'page-shani-dev' ),
        'darshan'      => array( 'दर्शन', 'Darshan', 'page-darshan' ),
        'seva'         => array( 'सेवा', 'Seva', 'page-seva' ),
        'donate'       => array( 'दान', 'Donate', 'page-donate' ),
        'bhandara'     => array( 'भंडारा', 'Bhandara', 'page-bhandara' ),
        'live-aarti'   => array( 'लाइव आरती', 'Live Aarti', 'page-live-aarti' ),
        'events'       => array( 'आयोजन', 'Events', 'page-events' ),
        'journal'      => array( 'जर्नल', 'Journal', 'page-journal' ),
        'gallery'      => array( 'गैलरी', 'Gallery', 'page-gallery' ),
        'visit-us'     => array( 'यात्रा', 'Visit Us', 'page-visit-us' ),
        'contact'      => array( 'संपर्क', 'Contact', 'page-contact' ),
        'experiences'  => array( 'भक्तों के अनुभव', 'Devotee Experiences', 'page-experiences' ),
        'transparency' => array( 'पारदर्शिता', 'Temple Transparency', 'page-transparency' ),
    );
}

function ss_ensure_pages( $set_homepage = true ) {
    $created = 0;
    foreach ( ss_pages_config() as $slug => $meta ) {
        $existing = get_page_by_path( $slug );
        if ( $existing ) continue;
        $id = wp_insert_post( array(
            'post_type'    => 'page',
            'post_status'  => 'publish',
            'post_title'   => $meta[0] . ' / ' . $meta[1],
            'post_name'    => $slug,
            'post_content' => '',
            'meta_input'   => array( '_wp_page_template' => $meta[2] . '.html' ),
        ) );
        if ( $id && ! is_wp_error( $id ) ) $created++;
    }
    // Home page
    $home = get_page_by_path( 'home' );
    if ( ! $home ) {
        $home_id = wp_insert_post( array(
            'post_type' => 'page', 'post_status' => 'publish',
            'post_title' => 'Home', 'post_name' => 'home',
            'post_content' => '',
        ) );
    } else {
        $home_id = $home->ID;
    }
    if ( $set_homepage && $home_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
    }
    return $created;
}

function ss_setup_pages_screen() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( isset( $_POST['ss_setup_pages'] ) && check_admin_referer( 'ss_setup_pages' ) ) {
        $created = ss_ensure_pages( true );
        echo '<div class="notice notice-success"><p>' . esc_html( $created ) . ' pages created / verified. Home page set as static front page.</p></div>';
    }
    echo '<div class="wrap"><h1>Siddh Sannidham — Setup Pages</h1>';
    echo '<p>This will create the standard Siddh Sannidham pages (About, Shani Dev, Darshan, Seva, Donate, Bhandara, Live Aarti, Events, Journal, Gallery, Visit Us, Contact, Experiences, Transparency) with the correct templates, and set the Home page as the static front page. Existing pages are not overwritten.</p>';
    echo '<form method="post">';
    wp_nonce_field( 'ss_setup_pages' );
    echo '<button type="submit" name="ss_setup_pages" class="button button-primary">Create / Verify Pages</button>';
    echo '</form></div>';
}

/* Seed sensible defaults on activation */
function ss_seed_defaults() {
    // Aartis
    if ( wp_count_posts( 'ss_aarti' )->publish < 1 ) {
        $defaults = array(
            array( 'Mangala Aarti', 'मंगला आरती', 'Mangala Aarti', '05:30' ),
            array( 'Bhog Aarti',    'भोग आरती',   'Bhog Aarti',    '12:00' ),
            array( 'Sandhya Aarti', 'संध्या आरती', 'Sandhya Aarti', '19:15' ),
            array( 'Shayan Aarti',  'शयन आरती',   'Shayan Aarti',  '21:30' ),
        );
        foreach ( $defaults as $a ) {
            $id = wp_insert_post( array( 'post_type' => 'ss_aarti', 'post_status' => 'publish', 'post_title' => $a[0] ) );
            update_post_meta( $id, '_ss_aarti_name_hi', $a[1] );
            update_post_meta( $id, '_ss_aarti_name_en', $a[2] );
            update_post_meta( $id, '_ss_aarti_time', $a[3] );
            update_post_meta( $id, '_ss_aarti_days', 'daily' );
            update_post_meta( $id, '_ss_aarti_active', '1' );
        }
    }
    // Seva
    if ( wp_count_posts( 'ss_seva' )->publish < 1 ) {
        $defaults = array(
            array( 'Anna Seva',   'अन्न सेवा',        'Anna Seva',        1101, 'Food',      'मंदिर आने वाले भक्तों के लिए भोजन प्रायोजित करें।', 'Sponsor meals for devotees visiting the temple.' ),
            array( 'Bhandara Seva','भंडारा सेवा',      'Bhandara Seva',    11001,'Community', 'विशेष दिनों पर सामुदायिक भंडारा का आयोजन करें।', 'Sponsor a community bhandara on special days.' ),
            array( 'Temple Seva', 'मंदिर सेवा',       'Temple Seva',      2501, 'Temple',    'मंदिर के रखरखाव एवं श्रृंगार में योगदान दें।', 'Contribute to temple maintenance and adornment.' ),
            array( 'Pujan Seva',  'पूजन सेवा',        'Pujan Seva',       1501, 'Puja',      'आपके नाम पर विशेष पूजा प्रायोजित करें।', 'Sponsor a special puja performed in your name.' ),
            array( 'Gau Seva',    'गौ सेवा',          'Gau Seva',         501,  'Community', 'हमारी गौशाला में गायों की सेवा में सहयोग करें।', 'Support the care of sacred cows at our goshala.' ),
            array( 'Needy Seva',  'जरूरतमंद सेवा',   'Needy Seva',       2101, 'Community', 'जरूरतमंद परिवारों को आवश्यक सामग्री उपलब्ध कराएं।', 'Support underprivileged families with essentials.' ),
        );
        foreach ( $defaults as $s ) {
            $id = wp_insert_post( array( 'post_type' => 'ss_seva', 'post_status' => 'publish', 'post_title' => $s[0] ) );
            update_post_meta( $id, '_ss_name_hi', $s[1] );
            update_post_meta( $id, '_ss_name_en', $s[2] );
            update_post_meta( $id, '_ss_amount', $s[3] );
            update_post_meta( $id, '_ss_category', $s[4] );
            update_post_meta( $id, '_ss_desc_hi', $s[5] );
            update_post_meta( $id, '_ss_desc_en', $s[6] );
            update_post_meta( $id, '_ss_seva_active', '1' );
        }
    }
    // Sample journal posts (only if none exist yet)
    if ( wp_count_posts()->publish < 2 ) {
        $samples = array(
            array( 'कौन हैं शनि देव?', 'शनि देव', 'शनि देव सूर्य पुत्र हैं और हिन्दू परंपरा में कर्म के देवता माने जाते हैं। उनकी दृष्टि सत्य, विनम्रता एवं सेवा के मार्ग पर चलने वाले भक्तों पर कृपापूर्ण होती है।' ),
            array( 'शनि बीज मंत्र एवं जाप विधि', 'मंत्र', 'शनि बीज मंत्र "ॐ प्रां प्रीं प्रौं सः शनैश्चराय नमः" का शनिवार को 108 बार जाप किया जाता है। पश्चिम की ओर मुख करके, सरसों के तेल का दीप जलाकर स्थिर श्वास एवं सात्विक हृदय से जाप करें।' ),
            array( 'शनिवार पूजन विधि', 'पूजन', 'प्रातः स्नान कर स्वच्छ वस्त्र धारण करें, शनि देव को सरसों का तेल, काले तिल एवं नील पुष्प अर्पित करें। शनि चालीसा का पाठ करें और विनम्रता से प्रार्थना करें।' ),
            array( 'कर्म और शनि देव', 'शनि देव', 'शनि देव को कर्म फलदाता कहा जाता है — कर्मों का फल देने वाले। उनकी शिक्षा सरल है: जो हम भाव से बोते हैं, वही कृपा से पाते हैं।' ),
            array( 'शनि जयंती — प्राकट्य दिवस', 'त्योहार', 'ज्येष्ठ अमावस्या को शनि जयंती मनाई जाती है। इस दिन विशेष अभिषेक, दीप-दान एवं सामुदायिक भंडारा आयोजित होते हैं।' ),
            array( 'भंडारा सेवा का महत्व', 'भंडारा', 'भंडारा — अन्नदान की परंपरा — भारतीय संस्कृति का सजीव अंग है। यह सेवा का सर्वोच्च रूप माना गया है।' ),
            array( 'मंदिर परंपरा एवं आचार', 'मंदिर परंपरा', 'मंदिर में मौन, स्वच्छता एवं अनुशासन आवश्यक हैं। यह न केवल शिष्टाचार है, बल्कि हमारे भीतर की शांति का प्रतिबिंब भी।' ),
            array( 'भक्ति — साधना का मूल', 'भक्ति', 'भक्ति का अर्थ केवल पूजा नहीं — यह प्रेम, समर्पण एवं सेवा का जीवन है। शनि देव के प्रति भक्ति सत्य एवं धर्म के मार्ग पर टिकी होती है।' ),
        );
        foreach ( $samples as $s ) {
            $cat = term_exists( $s[1], 'category' );
            if ( ! $cat ) $cat = wp_insert_term( $s[1], 'category' );
            $cat_ids = array( is_array( $cat ) ? $cat['term_id'] : (int) $cat );
            wp_insert_post( array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'post_title' => $s[0],
                'post_content' => $s[2],
                'post_category' => $cat_ids,
            ) );
        }
    }
}

register_activation_hook( __FILE__, function () {
    // Ensure CPTs are registered before creating anything
    do_action( 'init' );
    ss_seed_defaults();
    ss_ensure_pages( true );
    flush_rewrite_rules();
} );

/* ─────────── Donation intent handler ─────────── */
add_action( 'admin_post_nopriv_siddh_donation_intent', 'ss_donation_intent' );
add_action( 'admin_post_siddh_donation_intent', 'ss_donation_intent' );
function ss_donation_intent() {
    if ( ! isset( $_POST['siddh_nonce'] ) || ! wp_verify_nonce( $_POST['siddh_nonce'], 'siddh_donation' ) ) wp_die( 'Invalid request' );
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
    wp_insert_post( array(
        'post_type' => 'ss_contact', 'post_status' => 'private',
        'post_title' => 'Donation intent — ' . $data['name'] . ' ₹' . $amount,
        'post_content' => $data['message'],
        'meta_input' => array_map( 'wp_slash', $data ),
    ) );
    wp_safe_redirect( add_query_arg( 'donation_intent', 'ok', wp_get_referer() ?: home_url( '/donate' ) ) );
    exit;
}
