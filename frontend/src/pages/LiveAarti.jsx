import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";

const LiveAarti = () => {
  const { lang } = useLang();
  const t = useT();
  const [aartis, setAartis] = useState([]);
  useEffect(()=>{ api.get("/aarti-timings").then(r=>setAartis(r.data)); },[]);
  return (
    <div data-testid="live-aarti-page">
      <PageHero eyebrow={t("लाइव","LIVE")} titleHi="लाइव आरती एवं दर्शन" titleEn="Live Aarti & Darshan"
        subtitleHi="अब दूरी नहीं, दर्शन का अवसर हर समय।" subtitleEn="No distance too far — darshan is always available."
        image="https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20 grid lg:grid-cols-3 gap-6">
        <div className="lg:col-span-2 card-sacred overflow-hidden">
          <div className="aspect-video">
            <iframe src="https://www.youtube.com/embed/jfKfPfyJRdk?autoplay=0&mute=1" title="Live Darshan" allow="autoplay; encrypted-media" allowFullScreen className="w-full h-full" data-testid="live-youtube"/>
          </div>
          <div className="p-6 border-t border-gold-soft flex items-center justify-between">
            <div className="flex items-center gap-2 text-ivory"><span className="live-dot"/> {t("YouTube पर लाइव","Live on YouTube")}</div>
            <a href="#" className="text-gold text-sm hover:text-gold-light">Facebook Live →</a>
          </div>
        </div>
        <div className="card-sacred p-6" data-testid="aarti-schedule">
          <div className="text-xs uppercase tracking-widest text-gold mb-4">{t("आज की आरती","Today's Aartis")}</div>
          <ul className="space-y-4">
            {aartis.map(a=>(
              <li key={a.id} className="flex justify-between border-b border-gold-soft pb-3">
                <span className={lang==='hi'?'font-body-hi text-ivory':'text-ivory'}>{lang==='hi'?a.name_hi:a.name_en}</span>
                <span className="text-gold font-serif-en text-sm">{a.time}</span>
              </li>
            ))}
          </ul>
          <div className="mt-8 border-t border-gold-soft pt-6">
            <div className="text-xs uppercase tracking-widest text-gold mb-2">{t("आरती के बोल","Aarti Lyrics")}</div>
            <p className="font-mantra text-ivory/90 leading-loose text-lg">
              जय जय श्री शनि देव भक्तन हितकारी।<br/>सूरज के पुत्र प्रभु छाया महतारी॥
            </p>
          </div>
        </div>
      </section>
    </div>
  );
};
export default LiveAarti;
