<?php
/**
 * Title: Site Header
 * Slug: siddh-sannidham/site-header
 * Categories: siddh-sannidham
 * Inserter: false
 */
$home_url = esc_url( home_url( '/' ) );
$menu_items = function_exists( 'siddh_default_menu_items' ) ? siddh_default_menu_items() : array(
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
?>
<!-- wp:html -->
<header class="ss-header">
  <div class="ss-container ss-header-inner">
    <a class="ss-logo" href="<?php echo $home_url; ?>">
      <span class="ss-logo-emblem">
        <span aria-hidden="true">॥</span>
        <span class="slow-rotate" aria-hidden="true" style="position:absolute;inset:0;border-radius:50%;background:conic-gradient(from 0deg,transparent,rgba(212,175,55,.6),transparent);opacity:.3"></span>
      </span>
      <span>
        <span class="ss-logo-text-hi">सिद्ध सन्निधम्</span><br>
        <span class="ss-logo-text-en">SIDDH SANNIDHAM</span>
      </span>
    </a>

    <nav class="ss-nav" aria-label="Primary">
      <?php foreach ( $menu_items as $it ) :
        list( $url, $hi, $en ) = $it; ?>
        <a href="<?php echo esc_url( home_url( $url ) ); ?>" data-hi="<?php echo esc_attr( $hi ); ?>" data-en="<?php echo esc_attr( $en ); ?>"><?php echo esc_html( $hi ); ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="ss-header-cta">
      <div class="ss-lang" role="group" aria-label="Language">
        <button type="button" class="hi active" data-lang="hi">हिन्दी</button>
        <button type="button" class="en" data-lang="en">EN</button>
      </div>
      <a href="<?php echo esc_url( home_url( '/live-aarti' ) ); ?>" class="btn-outline-gold" style="display:none" data-desktop-cta>
        <span class="live-dot"></span><span data-hi="लाइव दर्शन" data-en="Live Darshan">लाइव दर्शन</span>
      </a>
      <a href="<?php echo esc_url( home_url( '/donate' ) ); ?>" class="btn-primary-gold">
        <span data-hi="दान करें" data-en="Donate">दान करें</span>
      </a>
      <button type="button" class="ss-hamburger" data-ss-hamburger aria-label="Menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
      </button>
    </div>
  </div>
  <div class="ss-container">
    <div class="ss-mobile-panel">
      <div class="ss-mobile-grid">
        <?php foreach ( $menu_items as $it ) :
          list( $url, $hi, $en ) = $it; ?>
          <a href="<?php echo esc_url( home_url( $url ) ); ?>" data-hi="<?php echo esc_attr( $hi ); ?>" data-en="<?php echo esc_attr( $en ); ?>"><?php echo esc_html( $hi ); ?></a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</header>
<style>@media(min-width:768px){[data-desktop-cta]{display:inline-flex !important}}</style>
<!-- /wp:html -->
