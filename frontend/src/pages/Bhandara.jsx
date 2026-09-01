import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { Link } from "react-router-dom";
import { Users, Calendar } from "lucide-react";

const Bhandara = () => {
  const { lang } = useLang();
  const t = useT();
  const [items, setItems] = useState([]);
  useEffect(()=>{ api.get("/bhandaras").then(r=>setItems(r.data)); },[]);
  return (
    <div data-testid="bhandara-page">
      <PageHero eyebrow="BHANDARA" titleHi="भंडारा — सेवा और प्रसाद का उत्सव" titleEn="Bhandara — A Celebration of Seva & Prasad"
        subtitleHi="कोई भी भक्त बिना प्रसाद के मंदिर से न जाए।" subtitleEn="Let no devotee leave the temple without prasad."
        image="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20">
        <div className="grid md:grid-cols-2 gap-8">
          {items.map(b=>(
            <div key={b.id} className="card-sacred overflow-hidden" data-testid={`bhandara-${b.id}`}>
              <img src={b.image} alt="" className="w-full h-56 object-cover"/>
              <div className="p-6">
                <div className="text-xs uppercase tracking-widest text-gold">{b.status}</div>
                <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory mt-2`}>{lang==='hi'?b.title_hi:b.title_en}</h3>
                <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory mt-3`}>{lang==='hi'?b.description_hi:b.description_en}</p>
                <div className="grid grid-cols-2 gap-4 mt-5 text-sm">
                  <div className="flex items-center gap-2 text-ivory/80"><Calendar className="w-4 h-4 text-gold"/>{b.date} · {b.time}</div>
                  <div className="flex items-center gap-2 text-ivory/80"><Users className="w-4 h-4 text-gold"/>{b.devotees_expected}+ {t("भक्त","devotees")}</div>
                </div>
                <div className="flex items-center justify-between mt-6">
                  <div>
                    <div className="text-xs text-muted-ivory">{t("पूर्ण प्रायोजन","Full Sponsorship")}</div>
                    <div className="text-gold font-serif-en text-lg">₹{b.sponsor_amount.toLocaleString('en-IN')}</div>
                  </div>
                  <Link to={`/donate?purpose=Bhandara+Seva&amount=${b.sponsor_amount}`} className="btn-primary-gold !text-xs" data-testid={`sponsor-${b.id}`}>
                    {t("प्रायोजित करें","Sponsor Bhandara")}
                  </Link>
                </div>
              </div>
            </div>
          ))}
        </div>
      </section>
    </div>
  );
};
export default Bhandara;
