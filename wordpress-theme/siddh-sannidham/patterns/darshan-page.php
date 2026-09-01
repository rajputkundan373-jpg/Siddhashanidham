<?php
/**
 * Title: Darshan (Full Page)
 * Slug: siddh-sannidham/darshan-page
 * Categories: siddh-sannidham
 */
$guidelines = array(
  array( 'स्वच्छ वस्त्र धारण करें', 'Wear clean, modest attire' ),
  array( 'गर्भगृह में मौन बनाए रखें', 'Maintain silence within the sanctum' ),
  array( 'चरण-पादुका बाहर उतारें', 'Remove footwear at entry' ),
  array( 'पंक्ति एवं व्यवस्था का पालन करें', 'Follow queues and staff directions' ),
  array( 'तेल एवं तिल शनि देव को अर्पित करें', 'Offer mustard oil & sesame to Shani Dev' ),
  array( 'प्रसाद को श्रद्धा से ग्रहण करें', 'Receive prasad with reverence' ),
);
$maps_url = siddh_get_option( 'maps_url', 'https://maps.google.com/?q=Etawa+Gwalior+Road+Madhya+Pradesh' );
?>
<!-- wp:html -->
<main>
<section style="position:relative;min-height:45vh;overflow:hidden">
  <div style="position:absolute;inset:0"><img src="https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1800&q=85" alt="" style="width:100%;height:100%;object-fit:cover;opacity:.5"><div style="position:absolute;inset:0;background:linear-gradient(to bottom,rgba(11,12,16,.6),rgba(11,12,16,1))"></div></div>
  <div class="ss-container" style="position:relative;padding:96px 24px 64px">
    <div class="ss-section-eyebrow">DARSHAN</div>
    <h1 style="font-family:'Rozha One',serif;font-size:clamp(2rem,5vw,4rem);color:#F6F4EE;margin:0;line-height:1.1"><span data-hi="दर्शन" data-en="Darshan">दर्शन</span></h1>
    <p class="text-muted-ivory" style="margin-top:20px;font-size:18px;max-width:720px"><span data-hi="शनि देव के पावन दर्शन का समय एवं मार्गदर्शन।" data-en="Timings and guidance for darshan of Shani Dev.">शनि देव के पावन दर्शन का समय एवं मार्गदर्शन।</span></p>
    <div class="gold-underline" style="margin-top:24px"></div>
  </div>
</section>
<!-- wp:pattern {"slug":"siddh-sannidham/darshan"} /-->
<section class="ss-section">
  <div class="ss-container">
    <h2 class="hi" style="font-family:'Rozha One',serif"><span data-hi="दर्शन दिशानिर्देश" data-en="Darshan Guidelines">दर्शन दिशानिर्देश</span></h2>
    <div class="gold-underline" style="margin:16px 0 32px"></div>
    <div class="ss-grid-2">
      <?php foreach ( $guidelines as $g ) : ?>
        <div class="card-sacred" style="display:flex;gap:12px;align-items:flex-start">
          <span class="text-gold" aria-hidden="true">◈</span>
          <span style="color:rgba(246,244,238,.9)"><span data-hi="<?php echo esc_attr( $g[0] ); ?>" data-en="<?php echo esc_attr( $g[1] ); ?>"><?php echo esc_html( $g[0] ); ?></span></span>
        </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:48px">
      <a class="btn-primary-gold" href="<?php echo esc_url( $maps_url ); ?>" target="_blank" rel="noopener"><span data-hi="मार्गदर्शन प्राप्त करें" data-en="Get Directions">मार्गदर्शन प्राप्त करें</span></a>
    </div>
  </div>
</section>
</main>
<!-- /wp:html -->
