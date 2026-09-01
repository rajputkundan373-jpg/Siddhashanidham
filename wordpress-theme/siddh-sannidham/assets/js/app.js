(function () {
  var d = document;
  // Language toggle
  var lang = (document.cookie.match(/(?:^|; )ss_lang=([^;]+)/) || [])[1] || 'hi';
  function setLang(l) {
    lang = l;
    document.cookie = 'ss_lang=' + l + '; path=/; max-age=' + 60 * 60 * 24 * 365;
    d.documentElement.setAttribute('data-lang', l);
    d.querySelectorAll('[data-hi],[data-en]').forEach(function (el) {
      var v = el.getAttribute('data-' + l);
      if (v !== null) el.textContent = v;
    });
    d.querySelectorAll('.ss-only-hi').forEach(function (el) { el.style.display = l === 'hi' ? '' : 'none'; });
    d.querySelectorAll('.ss-only-en').forEach(function (el) { el.style.display = l === 'en' ? '' : 'none'; });
    d.querySelectorAll('.ss-lang button').forEach(function (b) {
      b.classList.toggle('active', b.dataset.lang === l);
    });
  }
  d.addEventListener('click', function (e) {
    var b = e.target.closest('.ss-lang button');
    if (b) { setLang(b.dataset.lang); }
    var h = e.target.closest('[data-ss-hamburger]');
    if (h) {
      var p = d.querySelector('.ss-mobile-panel'); if (p) p.classList.toggle('open');
    }
  });
  d.addEventListener('DOMContentLoaded', function () { setLang(lang); });

  // Contact form submission
  d.addEventListener('submit', function (e) {
    var f = e.target.closest('[data-ss-form]');
    if (!f) return;
    e.preventDefault();
    var kind = f.getAttribute('data-ss-form');
    var data = Object.fromEntries(new FormData(f).entries());
    fetch(SSData.restUrl + 'siddh/v1/' + kind, {
      method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data)
    }).then(function (r) { return r.ok; }).then(function (ok) {
      var msg = f.querySelector('[data-ss-form-msg]');
      if (msg) msg.textContent = ok ? (lang === 'hi' ? 'धन्यवाद।' : 'Thank you.') : (lang === 'hi' ? 'त्रुटि हुई' : 'Something went wrong');
      if (ok) f.reset();
    });
  });

  // Temple open badge (client-side check for now)
  function updateOpenBadge() {
    var el = d.querySelector('[data-ss-temple-status]');
    if (!el || !SSData || !SSData.templeHours) return;
    try {
      var now = new Date(new Date().toLocaleString('en-US', { timeZone: SSData.timezone || 'Asia/Kolkata' }));
      var mins = now.getHours() * 60 + now.getMinutes();
      var o = SSData.templeHours.open.split(':'); var c = SSData.templeHours.close.split(':');
      var om = (+o[0]) * 60 + (+o[1]); var cm = (+c[0]) * 60 + (+c[1]);
      var open = mins >= om && mins <= cm;
      el.textContent = open ? (lang === 'hi' ? 'मंदिर खुला है' : 'MANDIR OPEN') : (lang === 'hi' ? 'मंदिर बंद है' : 'MANDIR CLOSED');
      el.classList.toggle('is-open', open);
    } catch (_) {}
  }
  d.addEventListener('DOMContentLoaded', updateOpenBadge);
  setInterval(updateOpenBadge, 60000);
})();
