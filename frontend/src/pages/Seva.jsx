import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { Link } from "react-router-dom";

const Seva = () => {
  const { lang } = useLang();
  const t = useT();
  const [items, setItems] = useState([]);
  useEffect(()=>{ api.get("/seva").then(r=>setItems(r.data)); },[]);
  return (
    <div data-testid="seva-page">
      <PageHero eyebrow="SEVA" titleHi="सेवा — भक्ति का अनुष्ठान" titleEn="Seva — The Practice of Devotion"
        subtitleHi="भक्तगण विभिन्न सेवाओं में सम्मिलित होकर पुण्य अर्जित कर सकते हैं।" subtitleEn="Devotees can participate in various forms of seva and share in the merit."
        image="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20">
        <div className="grid md:grid-cols-2 gap-6">
          {items.map(s=>(
            <div key={s.id} className="card-sacred p-8" data-testid={`seva-item-${s.id}`}>
              <div className="flex justify-between items-baseline">
                <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory`}>{lang==='hi'?s.name_hi:s.name_en}</h3>
                <span className="text-gold font-serif-en">₹{s.amount.toLocaleString('en-IN')}</span>
              </div>
              <div className="text-xs uppercase tracking-widest text-gold mt-2">{s.category}</div>
              <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory mt-4 leading-relaxed`}>{lang==='hi'?s.description_hi:s.description_en}</p>
              <Link to={`/donate?purpose=${encodeURIComponent(s.name_en)}&amount=${s.amount}`} className="btn-primary-gold mt-6 inline-flex !text-xs" data-testid={`seva-participate-${s.id}`}>
                {t("सेवा में सम्मिलित हों","Participate in Seva")}
              </Link>
            </div>
          ))}
        </div>
      </section>
    </div>
  );
};
export default Seva;
