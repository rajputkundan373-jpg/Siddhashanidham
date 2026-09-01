import { NavLink, Link } from "react-router-dom";
import { useState } from "react";
import { Menu, X, Heart, Radio } from "lucide-react";
import { useLang, useT } from "../lib/i18n";

const NAV_LINKS = [
  { path: "/", hi: "मुख्य", en: "Home" },
  { path: "/about", hi: "परिचय", en: "About" },
  { path: "/shani-dev", hi: "शनि देव", en: "Shani Dev" },
  { path: "/darshan", hi: "दर्शन", en: "Darshan" },
  { path: "/seva", hi: "सेवा", en: "Seva" },
  { path: "/bhandara", hi: "भंडारा", en: "Bhandara" },
  { path: "/live-aarti", hi: "लाइव आरती", en: "Live Aarti" },
  { path: "/events", hi: "आयोजन", en: "Events" },
  { path: "/journal", hi: "जर्नल", en: "Journal" },
  { path: "/gallery", hi: "गैलरी", en: "Gallery" },
  { path: "/visit-us", hi: "यात्रा", en: "Visit Us" },
  { path: "/contact", hi: "संपर्क", en: "Contact" },
];

const Navbar = () => {
  const [open, setOpen] = useState(false);
  const { lang, setLang } = useLang();
  const t = useT();

  return (
    <header
      className="sticky top-0 z-50 backdrop-blur-2xl bg-[#0B0C10]/85 border-b border-gold-soft"
      data-testid="site-navbar"
    >
      <div className="max-w-[1400px] mx-auto px-5 lg:px-10">
        <div className="flex items-center justify-between h-20">
          <Link to="/" className="flex items-center gap-3 group" data-testid="nav-logo">
            <div className="relative w-11 h-11 rounded-full border border-gold-strong flex items-center justify-center overflow-hidden">
              <span className="text-gold font-serif-en text-lg">॥</span>
              <span className="absolute inset-0 rounded-full slow-rotate opacity-30" style={{background:"conic-gradient(from 0deg, transparent, rgba(212,175,55,0.6), transparent)"}} />
            </div>
            <div className="leading-tight">
              <div className="font-devanagari text-gold text-lg">सिद्ध सन्निधम्</div>
              <div className="font-serif-en text-[10px] tracking-[0.32em] text-muted-ivory">SIDDH SANNIDHAM</div>
            </div>
          </Link>

          <nav className="hidden xl:flex items-center gap-6" data-testid="nav-desktop-links">
            {NAV_LINKS.map(l => (
              <NavLink key={l.path} to={l.path} end={l.path === "/"}
                data-testid={`nav-link-${l.path.replace('/', '') || 'home'}`}
                className={({isActive}) =>
                  `text-[13px] tracking-wider uppercase transition-colors ${isActive ? 'text-gold' : 'text-ivory/80 hover:text-gold'}`}>
                {lang === "hi" ? <span className="font-body-hi normal-case text-sm">{l.hi}</span> : l.en}
              </NavLink>
            ))}
          </nav>

          <div className="flex items-center gap-3">
            <div className="hidden md:flex items-center gap-1 border border-gold-soft rounded-full p-1" data-testid="lang-switcher">
              <button data-testid="lang-hi" onClick={() => setLang("hi")}
                className={`px-3 py-1 rounded-full text-xs font-body-hi transition ${lang === "hi" ? "bg-[#D4AF37] text-[#0B0C10]" : "text-ivory/80"}`}>
                हिन्दी
              </button>
              <button data-testid="lang-en" onClick={() => setLang("en")}
                className={`px-3 py-1 rounded-full text-xs font-serif-en tracking-wider transition ${lang === "en" ? "bg-[#D4AF37] text-[#0B0C10]" : "text-ivory/80"}`}>
                EN
              </button>
            </div>

            <Link to="/live-aarti" className="hidden md:inline-flex btn-outline-gold !py-2.5 !text-xs" data-testid="nav-live-darshan">
              <span className="live-dot" /> <Radio className="w-3.5 h-3.5" /> {t("लाइव दर्शन","Live Darshan")}
            </Link>
            <Link to="/donate" className="btn-primary-gold !py-2.5 !text-xs" data-testid="nav-donate-btn">
              <Heart className="w-3.5 h-3.5" /> {t("दान करें","Donate")}
            </Link>

            <button className="xl:hidden text-gold p-2" onClick={() => setOpen(!open)} data-testid="nav-mobile-toggle" aria-label="menu">
              {open ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
            </button>
          </div>
        </div>

        {open && (
          <div className="xl:hidden pb-6 border-t border-gold-soft mt-2 pt-4" data-testid="nav-mobile-panel">
            <div className="grid grid-cols-2 gap-3">
              {NAV_LINKS.map(l => (
                <NavLink key={l.path} to={l.path} end={l.path === "/"} onClick={() => setOpen(false)}
                  className={({isActive}) => `text-sm py-2 ${isActive ? 'text-gold' : 'text-ivory/85'}`}>
                  {lang === "hi" ? <span className="font-body-hi">{l.hi}</span> : l.en}
                </NavLink>
              ))}
            </div>
            <div className="flex items-center gap-2 mt-5">
              <button onClick={() => setLang("hi")} className={`flex-1 py-2 rounded-full text-sm font-body-hi border ${lang === "hi" ? "bg-[#D4AF37] text-[#0B0C10] border-transparent" : "border-gold-soft text-ivory"}`}>हिन्दी</button>
              <button onClick={() => setLang("en")} className={`flex-1 py-2 rounded-full text-sm font-serif-en border ${lang === "en" ? "bg-[#D4AF37] text-[#0B0C10] border-transparent" : "border-gold-soft text-ivory"}`}>EN</button>
            </div>
          </div>
        )}
      </div>
    </header>
  );
};

export default Navbar;
