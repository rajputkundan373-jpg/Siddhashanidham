<?php
/**
 * Title: Journal Categories
 * Slug: siddh-sannidham/journal-categories
 * Categories: siddh-sannidham
 */
$cats = array(
  array( 'शनि देव',         'Shani Dev',         'शनि साधना एवं ज्ञान',           'Shani sadhana & wisdom' ),
  array( 'आध्यात्मिक ज्ञान', 'Spiritual Wisdom',  'भारतीय अध्यात्म का सार',          'The essence of Indian spirituality' ),
  array( 'मंदिर परंपरा',    'Temple Traditions', 'सिद्ध सन्निधम् की परंपराएँ',      'Traditions of Siddh Sannidham' ),
  array( 'भक्ति',           'Bhakti',            'भक्ति और श्रद्धा के मार्ग',        'The paths of devotion' ),
  array( 'सेवा',            'Seva',              'सेवा भाव, दान एवं समर्पण',        'Seva, daan and dedication' ),
  array( 'भंडारा',          'Bhandara',          'सामुदायिक प्रसाद एवं भोज',       'Community prasad & meals' ),
  array( 'त्योहार',         'Festivals',         'व्रत, उत्सव एवं जयंतियाँ',        'Vratas, festivals and jayantis' ),
  array( 'मंत्र',           'Mantras',           'शनि बीज एवं अन्य मंत्र',          'Shani beej & other mantras' ),
  array( 'पूजन',           'Puja Vidhi',        'विधिवत पूजन का मार्गदर्शन',      'Guidance for traditional pujan' ),
  array( 'मंदिर समाचार',    'Temple News',       'सिद्ध सन्निधम् की सूचनाएँ',       'News from Siddh Sannidham' ),
);
?>
<!-- wp:html -->
<section class="ss-section bg-slate-t" style="border-top:1px solid rgba(212,175,55,.22);border-bottom:1px solid rgba(212,175,55,.22)">
  <div class="ss-container">
    <div class="ss-section-eyebrow" data-hi="जर्नल श्रेणियाँ" data-en="Journal Categories">जर्नल श्रेणियाँ</div>
    <h2 class="hi">विषय के अनुसार पढ़ें</h2>
    <div class="gold-underline" style="margin:16px 0 12px"></div>
    <p class="text-muted-ivory" style="max-width:640px;margin-bottom:40px"><span data-hi="शनि देव, अध्यात्म, मंत्र, पूजन एवं मंदिर परंपरा पर लेख।" data-en="Essays on Shani Dev, spirituality, mantras, pujan and temple traditions.">शनि देव, अध्यात्म, मंत्र, पूजन एवं मंदिर परंपरा पर लेख।</span></p>

    <div class="ss-cat-grid">
      <?php foreach ( $cats as $c ) :
        $slug = urlencode( $c[0] );
        $count = 0;
        $term = get_term_by( 'name', $c[0], 'category' );
        if ( $term ) $count = (int) $term->count;
      ?>
        <a class="ss-cat-card" href="<?php echo esc_url( home_url( '/journal?cat=' . $slug ) ); ?>">
          <div class="ss-cat-emblem" aria-hidden="true">◈</div>
          <div class="ss-cat-body">
            <div class="ss-cat-title"><span data-hi="<?php echo esc_attr( $c[0] ); ?>" data-en="<?php echo esc_attr( $c[1] ); ?>"><?php echo esc_html( $c[0] ); ?></span></div>
            <div class="ss-cat-desc"><span data-hi="<?php echo esc_attr( $c[2] ); ?>" data-en="<?php echo esc_attr( $c[3] ); ?>"><?php echo esc_html( $c[2] ); ?></span></div>
            <?php if ( $count ) : ?><div class="ss-cat-count"><?php echo esc_html( $count ); ?> <span data-hi="लेख" data-en="articles">लेख</span></div><?php endif; ?>
          </div>
          <div class="ss-cat-arrow" aria-hidden="true">→</div>
        </a>
      <?php endforeach; ?>
    </div>

    <div style="text-align:center;margin-top:40px">
      <a class="btn-outline-gold" href="<?php echo esc_url( home_url( '/journal' ) ); ?>"><span data-hi="सभी लेख देखें" data-en="View All Articles">सभी लेख देखें</span> →</a>
    </div>
  </div>
</section>
<style>
.ss-cat-grid{display:grid;grid-template-columns:1fr;gap:16px}
@media(min-width:640px){.ss-cat-grid{grid-template-columns:repeat(2,1fr)}}
@media(min-width:1024px){.ss-cat-grid{grid-template-columns:repeat(3,1fr)}}
.ss-cat-card{display:flex;align-items:center;gap:16px;padding:20px 22px;background:rgba(18,20,26,.9);border:1px solid rgba(212,175,55,.22);border-radius:14px;transition:all .3s;color:inherit;text-decoration:none}
.ss-cat-card:hover{border-color:rgba(212,175,55,.55);transform:translateY(-2px);box-shadow:0 12px 32px rgba(212,175,55,.08)}
.ss-cat-emblem{width:44px;height:44px;flex:0 0 44px;border-radius:50%;border:1px solid rgba(212,175,55,.55);display:flex;align-items:center;justify-content:center;color:#D4AF37;font-family:'Cinzel',serif;font-size:16px}
.ss-cat-body{flex:1;min-width:0}
.ss-cat-title{font-family:'Rozha One',serif;color:#F6F4EE;font-size:18px;line-height:1.2}
.ss-cat-desc{color:#B0B7C3;font-size:13px;margin-top:4px;line-height:1.5}
.ss-cat-count{color:#D4AF37;font-family:'Cinzel',serif;font-size:11px;letter-spacing:.14em;text-transform:uppercase;margin-top:6px}
.ss-cat-arrow{color:#D4AF37;font-family:'Cinzel',serif;font-size:20px;opacity:.6;transition:transform .3s}
.ss-cat-card:hover .ss-cat-arrow{opacity:1;transform:translateX(4px)}
</style>
<!-- /wp:html -->
