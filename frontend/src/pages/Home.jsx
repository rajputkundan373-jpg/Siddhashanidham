import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { useLang, useT, pick } from "../lib/i18n";
import { api } from "../lib/api";
import { SectionHeader, Ornament } from "../components/Section";
import { Radio, Heart, MapPin, ChevronRight, Clock, Sparkles, Users, Utensils, Flame, HandHeart, BookOpen } from "lucide-react";

const HERO_IMG = "https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1800&q=90";
const TEMPLE_IMG = "https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1600&q=85";
const SHANI_IMG = "https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1600&q=85";

const Home = () => {
  const { lang } = useLang();
  const t = useT();
  const [today, setToday] = useState(null);
  const [aartis, setAartis] = useState([]);
  const [seva, setSeva] = useState([]);
  const [events, setEvents] = useState([]);

  useEffect(() => {
    api.get("/today").then(r => setToday(r.data));
    api.get("/aarti-timings").then(r => setAartis(r.data));
    api.get("/seva").then(r => setSeva(r.data));
    api.get("/events").then(r => setEvents(r.data.slice(0, 3)));
  }, []);

  const whyCards = [
    { hi: "दर्शन", en: "Darshan", icon: Sparkles, desc_hi: "पावन गर्भगृह में शनि देव के दर्शन।", desc_en: "Darshan of Shani Dev in the sacred sanctum." },
    { hi: "पूजन", en: "Pujan", icon: Flame, desc_hi: "पारंपरिक विधि से अभिषेक एवं पूजन।", desc_en: "Traditional abhishekam and pujan rituals." },
    { hi: "शनिवार सेवा", en: "Saturday Seva", icon: HandHeart, desc_hi: "हर शनिवार विशेष आरती एवं सेवा।", desc_en: "Special Saturday aarti and dedicated seva." },
    { hi: "भंडारा", en: "Bhandara", icon: Utensils, desc_hi: "सात्विक प्रसाद, सामुदायिक भोजन।", desc_en: "Sattvic prasad and community meal." },
    { hi: "विशेष अनुष्ठान", en: "Special Rituals", icon: BookOpen, desc_hi: "अमावस्या एवं जयंती के अनुष्ठान।", desc_en: "Rituals on Amavasya and Jayanti." },
    { hi: "सामुदायिक सेवा", en: "Community Seva", icon: Users, desc_hi: "गौ सेवा, अन्न सेवा एवं जरूरतमंद सेवा।", desc_en: "Gau seva, food seva and support for the needy." },
  ];

  return (
    <div data-testid="home-page">
      {/* HERO */}
      <section className="relative min-h-[92vh] overflow-hidden grain-overlay" data-testid="home-hero">
        <div className="absolute inset-0">
          <img src={HERO_IMG} alt="Sacred aarti flames" className="w-full h-full object-cover object-center opacity-60" />
          <div className="absolute inset-0 bg-gradient-to-b from-[#0B0C10]/70 via-[#0B0C10]/40 to-[#0B0C10]" />
        </div>
        <div className="relative max-w-[1400px] mx-auto px-6 lg:px-10 pt-24 pb-32">
          <div className="fade-up">
            <div className="font-mantra text-gold-light text-lg sm:text-xl tracking-wider mb-8">
              ॥ ॐ नीलांजनसमाभासं रविपुत्रं यमाग्रजम् ॥
            </div>
            <div className="text-xs uppercase tracking-[0.4em] text-gold mb-6">॥ श्री शनिदेवाय नमः ॥</div>
            <h1 className="font-serif-en text-5xl sm:text-6xl lg:text-7xl text-ivory leading-[1.05] max-w-4xl">
              SIDDH<br/>SANNIDHAM
            </h1>
            <div className="font-devanagari text-gold text-2xl sm:text-3xl mt-8">
              "एक आस्था, एक साधना, एक दिव्य अनुभव"
            </div>
            <p className="font-serif-en italic text-muted-ivory mt-4 text-lg max-w-2xl">
              A Sacred Space of Faith, Seva & Spirituality
            </p>
            <div className="flex flex-wrap gap-4 mt-12">
              <Link to="/live-aarti" className="btn-primary-gold" data-testid="hero-live-darshan">
                <span className="live-dot"/> {t("लाइव दर्शन","Live Darshan")}
              </Link>
              <Link to="/visit-us" className="btn-outline-gold" data-testid="hero-plan-visit">
                <MapPin className="w-4 h-4"/> {t("यात्रा योजना","Plan Your Visit")}
              </Link>
              <Link to="/donate" className="btn-outline-gold" data-testid="hero-donate">
                <Heart className="w-4 h-4"/> {t("दान करें","Donate")}
              </Link>
            </div>
          </div>
          <div className="absolute right-6 lg:right-10 top-24 hidden lg:flex flex-col items-end gap-4 text-right">
            <div className="border border-gold-soft rounded-full px-4 py-2 backdrop-blur-md bg-[#0B0C10]/50 text-xs tracking-widest text-gold-light" data-testid="hero-live-badge">
              <span className="live-dot mr-2" /> {t("मंदिर खुला है","MANDIR OPEN")}
            </div>
            <div className="text-xs text-muted-ivory">{t("अगली आरती","Next Aarti")}</div>
            <div className="font-serif-en text-gold text-3xl">07:15 PM</div>
          </div>
        </div>
      </section>

      {/* TEMPLE INTRO */}
      <section className="max-w-[1400px] mx-auto px-6 lg:px-10 py-24 mandala-bg" data-testid="home-intro">
        <div className="grid lg:grid-cols-2 gap-16 items-center">
          <div className="relative">
            <img src={TEMPLE_IMG} alt="Temple architecture" className="w-full h-[500px] object-cover rounded-lg gold-glow"/>
            <div className="absolute -bottom-6 -left-6 hidden lg:block bg-void border border-gold-soft rounded-xl px-6 py-4">
              <div className="text-xs uppercase tracking-widest text-gold">{t("स्थान","Location")}</div>
              <div className="text-ivory mt-1 text-sm">{t("इटावा-ग्वालियर मार्ग, म.प्र.","Etawa–Gwalior Road, MP")}</div>
            </div>
          </div>
          <div>
            <SectionHeader eyebrow="ॐ" titleHi="सिद्ध सन्निधम्" titleEn="Siddh Sannidham" lang={lang} />
            <p className={`${lang==='hi'?'font-body-hi':''} text-ivory/85 leading-[1.9] text-lg`}>
              {t("इटावा-ग्वालियर मार्ग पर स्थित सिद्ध सन्निधम् एक पावन शनि धाम है, जहाँ भक्त शनि देव के सम्मुख अपनी श्रद्धा एवं भक्ति समर्पित करते हैं। यह स्थान केवल एक मंदिर नहीं — यह न्याय, अनुशासन एवं सेवा का जीवंत केंद्र है।",
                 "Situated on the Etawa–Gwalior road, Siddh Sannidham is a sacred Shani dham where devotees offer their faith and devotion before Shani Dev. It is not merely a temple — it is a living centre of justice, discipline and seva.")}
            </p>
            <Link to="/about" className="mt-8 inline-flex items-center gap-2 text-gold hover:text-gold-light transition text-sm uppercase tracking-widest" data-testid="intro-learn-more">
              {t("मंदिर के विषय में जानें","Know Our Temple")} <ChevronRight className="w-4 h-4"/>
            </Link>
          </div>
        </div>
      </section>

      {/* LIVE DARSHAN */}
      <section className="bg-slate-t border-y border-gold-soft py-24" data-testid="home-live-darshan">
        <div className="max-w-[1400px] mx-auto px-6 lg:px-10">
          <div className="text-center max-w-2xl mx-auto mb-10">
            <div className="text-xs uppercase tracking-[0.32em] text-gold mb-4 flex items-center justify-center gap-2">
              <span className="live-dot"/> LIVE DARSHAN
            </div>
            <h2 className="font-devanagari text-3xl sm:text-4xl text-ivory">"अब दूरी नहीं, दर्शन का अवसर हर समय"</h2>
            <p className="text-muted-ivory mt-4 font-serif-en italic">No distance too far — Darshan awaits you always</p>
          </div>
          <div className="grid lg:grid-cols-3 gap-6">
            <div className="lg:col-span-2 relative rounded-xl overflow-hidden border border-gold-soft bg-void aspect-video" data-testid="live-video-frame">
              <iframe className="w-full h-full" src="https://www.youtube.com/embed/jfKfPfyJRdk?autoplay=0&mute=1" title="Live Darshan"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media" allowFullScreen />
              <div className="absolute top-4 left-4 bg-void/80 border border-red-500/50 rounded-full px-3 py-1 text-xs text-ivory flex items-center gap-2"><span className="live-dot"/> LIVE</div>
            </div>
            <div className="card-sacred p-6" data-testid="aarti-timings-card">
              <div className="text-xs uppercase tracking-widest text-gold mb-4 flex items-center gap-2"><Clock className="w-4 h-4"/>{t("आज की आरती","Today's Aartis")}</div>
              <ul className="space-y-4">
                {aartis.map(a => (
                  <li key={a.id} className="flex justify-between items-baseline border-b border-gold-soft pb-3">
                    <span className={lang==='hi'?'font-body-hi text-ivory':'font-serif-en text-ivory'}>{lang==='hi'?a.name_hi:a.name_en}</span>
                    <span className="text-gold font-serif-en text-sm">{a.time}</span>
                  </li>
                ))}
              </ul>
              <Link to="/live-aarti" className="mt-6 inline-flex items-center gap-2 text-sm text-gold hover:text-gold-light" data-testid="watch-live-btn">
                {t("पूर्ण अनुसूची","Full Schedule")} <ChevronRight className="w-4 h-4"/>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* TODAY AT TEMPLE */}
      {today && (
        <section className="max-w-[1400px] mx-auto px-6 lg:px-10 py-24" data-testid="home-today">
          <SectionHeader eyebrow={t("आज का दिन","Today")} titleHi="आज सिद्ध सन्निधम् में" titleEn="Today at Siddh Sannidham" lang={lang}
            subtitle={t("प्रतिदिन मंदिर से ताज़ा जानकारी","Fresh daily update from our sanctum")} />
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {[
              {hi:"आज का दिन",en:"Day", val:t(today.day_hi, today.day_en)},
              {hi:"आज की आरती",en:"Aarti", val:t(today.aarti_hi, today.aarti_en)},
              {hi:"आज की पूजा",en:"Puja", val:t(today.puja_hi, today.puja_en)},
              {hi:"आज का भंडारा",en:"Bhandara", val:t(today.bhandara_hi, today.bhandara_en)},
              {hi:"विशेष आयोजन",en:"Special", val:t(today.special_event_hi, today.special_event_en)},
              {hi:"शुभ नोट",en:"Note", val:t(today.special_note_hi, today.special_note_en)},
            ].map((it,i)=>(
              <div key={i} className="card-sacred p-6" data-testid={`today-card-${i}`}>
                <div className="text-xs uppercase tracking-widest text-gold mb-3">{t(it.hi,it.en)}</div>
                <div className={`${lang==='hi'?'font-body-hi':''} text-ivory text-lg`}>{it.val}</div>
              </div>
            ))}
          </div>
        </section>
      )}

      {/* SHANI DEV */}
      <section className="relative py-24 overflow-hidden" data-testid="home-shani-section">
        <div className="absolute inset-0 opacity-30">
          <img src={SHANI_IMG} alt="Shani Dev" className="w-full h-full object-cover"/>
          <div className="absolute inset-0 bg-gradient-to-r from-[#0B0C10] via-[#0B0C10]/70 to-transparent" />
        </div>
        <div className="relative max-w-[1400px] mx-auto px-6 lg:px-10">
          <div className="max-w-2xl">
            <div className="text-xs uppercase tracking-[0.32em] text-gold mb-4">SHANI DEV</div>
            <h2 className="font-devanagari text-3xl sm:text-4xl lg:text-5xl text-ivory leading-tight">
              शनि देव — न्याय, कर्म और अनुशासन के देवता
            </h2>
            <p className={`${lang==='hi'?'font-body-hi':''} text-ivory/85 mt-6 leading-[1.9] text-lg`}>
              {t("शनि देव सूर्य पुत्र हैं और हिन्दू परंपरा में कर्मफल के देवता माने जाते हैं। उनकी दृष्टि उन भक्तों पर सदैव कृपापूर्ण होती है जो सत्य, विनम्रता एवं सेवा के मार्ग पर चलते हैं।",
                 "Shani Dev, son of Surya, is revered as the deity of karma in the Hindu tradition. His gaze remains ever-grace-filled upon devotees who walk the path of truth, humility and service.")}
            </p>
            <Link to="/shani-dev" className="mt-8 btn-outline-gold inline-flex" data-testid="shani-explore-btn">
              {t("शनि देव के बारे में जानें","Explore Shani Dev")} <ChevronRight className="w-4 h-4"/>
            </Link>
          </div>
        </div>
      </section>

      {/* WHY VISIT */}
      <section className="max-w-[1400px] mx-auto px-6 lg:px-10 py-24" data-testid="home-why-visit">
        <SectionHeader eyebrow={t("दर्शनार्थियों के लिए","For Devotees")} titleHi="क्यों करें सिद्ध सन्निधम् की यात्रा" titleEn="Why Devotees Visit Siddh Sannidham" lang={lang} />
        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {whyCards.map((c, i) => {
            const Icon = c.icon;
            return (
              <div key={i} className="card-sacred p-8" data-testid={`why-card-${i}`}>
                <div className="w-12 h-12 rounded-full border border-gold-strong flex items-center justify-center mb-6">
                  <Icon className="w-5 h-5 text-gold"/>
                </div>
                <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory`}>{lang==='hi'?c.hi:c.en}</h3>
                <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory mt-3 leading-relaxed`}>{lang==='hi'?c.desc_hi:c.desc_en}</p>
              </div>
            );
          })}
        </div>
      </section>

      {/* SEVA */}
      <section className="bg-slate-t border-y border-gold-soft py-24" data-testid="home-seva">
        <div className="max-w-[1400px] mx-auto px-6 lg:px-10">
          <SectionHeader eyebrow="SEVA" titleHi="सिद्ध सन्निधम् में सेवा" titleEn="Seva at Siddh Sannidham" lang={lang}
            subtitle={t("भक्तगण विभिन्न सेवाओं में सम्मिलित होकर पुण्य लाभ अर्जित कर सकते हैं।","Devotees may participate in various forms of seva and share in the merit.")} />
          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {seva.slice(0,6).map((s) => (
              <div key={s.id} className="card-sacred p-6" data-testid={`seva-card-${s.id}`}>
                <div className="flex justify-between items-start mb-4">
                  <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-xl text-ivory`}>{lang==='hi'?s.name_hi:s.name_en}</h3>
                  <span className="text-gold text-sm font-serif-en">₹{s.amount.toLocaleString('en-IN')}</span>
                </div>
                <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory text-sm leading-relaxed`}>{lang==='hi'?s.description_hi:s.description_en}</p>
                <Link to={`/donate?purpose=${encodeURIComponent(s.name_en)}`} className="mt-5 inline-flex text-sm text-gold hover:text-gold-light items-center gap-2" data-testid={`seva-donate-${s.id}`}>
                  {t("योगदान करें","Contribute")} <ChevronRight className="w-4 h-4"/>
                </Link>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* EVENTS */}
      <section className="max-w-[1400px] mx-auto px-6 lg:px-10 py-24" data-testid="home-events">
        <SectionHeader eyebrow={t("आगामी","Upcoming")} titleHi="आगामी आयोजन" titleEn="Upcoming Events" lang={lang} />
        <div className="grid md:grid-cols-3 gap-6">
          {events.map(ev => (
            <Link to="/events" key={ev.id} className="group card-sacred overflow-hidden" data-testid={`event-card-${ev.id}`}>
              <div className="relative h-56 overflow-hidden">
                <img src={ev.image} alt="" className="w-full h-full object-cover group-hover:scale-105 transition duration-500"/>
                <div className="absolute inset-0 bg-gradient-to-t from-void via-transparent"/>
              </div>
              <div className="p-6">
                <div className="text-xs uppercase tracking-widest text-gold">{ev.category}</div>
                <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-xl text-ivory mt-3`}>{lang==='hi'?ev.title_hi:ev.title_en}</h3>
                <div className="text-muted-ivory mt-3 text-sm">{ev.date} · {ev.time}</div>
              </div>
            </Link>
          ))}
        </div>
        <Ornament/>
        <div className="text-center">
          <Link to="/events" className="btn-outline-gold inline-flex" data-testid="events-view-all">
            {t("सभी आयोजन देखें","View All Events")} <ChevronRight className="w-4 h-4"/>
          </Link>
        </div>
      </section>

      {/* DONATE CTA */}
      <section className="relative overflow-hidden py-24" data-testid="home-donate-cta">
        <div className="absolute inset-0 bg-gradient-to-br from-[#0F1A2E] via-[#12141A] to-[#0B0C10]" />
        <div className="relative max-w-[1400px] mx-auto px-6 lg:px-10 text-center">
          <div className="text-xs uppercase tracking-[0.32em] text-gold mb-4">DONATE</div>
          <h2 className="font-devanagari text-3xl sm:text-4xl lg:text-5xl text-ivory">आपकी श्रद्धा, हमारी सेवा</h2>
          <p className="font-serif-en italic text-muted-ivory mt-4 max-w-xl mx-auto">Your devotion powers our seva</p>
          <Link to="/donate" className="btn-primary-gold mt-10 inline-flex" data-testid="cta-donate-button">
            <Heart className="w-4 h-4"/> {t("अभी दान करें","Donate Now")}
          </Link>
        </div>
      </section>
    </div>
  );
};

export default Home;
