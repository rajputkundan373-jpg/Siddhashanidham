import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { Calendar, MapPin } from "lucide-react";

const Events = () => {
  const { lang } = useLang();
  const t = useT();
  const [events, setEvents] = useState([]);
  const [filter, setFilter] = useState("All");
  useEffect(()=>{ api.get("/events").then(r=>setEvents(r.data)); },[]);
  const cats = ["All", ...new Set(events.map(e=>e.category))];
  const filtered = filter==="All"?events:events.filter(e=>e.category===filter);
  return (
    <div data-testid="events-page">
      <PageHero eyebrow="EVENTS" titleHi="आयोजन एवं उत्सव" titleEn="Events & Celebrations"
        subtitleHi="आगामी अनुष्ठान, महोत्सव एवं विशेष सेवाएँ।" subtitleEn="Upcoming rituals, festivals and special observances."
        image="https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20">
        <div className="flex flex-wrap gap-3 mb-10" data-testid="events-filter">
          {cats.map(c=>(
            <button key={c} onClick={()=>setFilter(c)} data-testid={`filter-${c}`}
              className={`px-4 py-2 rounded-full border text-xs uppercase tracking-widest transition ${filter===c?'bg-[#D4AF37] text-void border-transparent':'border-gold-soft text-ivory/85 hover:border-gold-strong'}`}>
              {c}
            </button>
          ))}
        </div>
        <div className="grid md:grid-cols-2 gap-8">
          {filtered.map(e=>(
            <div key={e.id} className="card-sacred overflow-hidden" data-testid={`event-${e.id}`}>
              <img src={e.image} alt="" className="w-full h-52 object-cover"/>
              <div className="p-6">
                <div className="text-xs uppercase tracking-widest text-gold">{e.category}</div>
                <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory mt-2`}>{lang==='hi'?e.title_hi:e.title_en}</h3>
                <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory mt-3`}>{lang==='hi'?e.description_hi:e.description_en}</p>
                <div className="mt-5 space-y-2 text-sm text-ivory/85">
                  <div className="flex items-center gap-2"><Calendar className="w-4 h-4 text-gold"/>{e.date} · {e.time}</div>
                  <div className="flex items-center gap-2"><MapPin className="w-4 h-4 text-gold"/>{e.location}</div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </section>
    </div>
  );
};
export default Events;
