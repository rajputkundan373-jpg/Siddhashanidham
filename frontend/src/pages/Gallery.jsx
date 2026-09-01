import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { X } from "lucide-react";

const Gallery = () => {
  const { lang } = useLang();
  const t = useT();
  const [photos, setPhotos] = useState([]);
  const [videos, setVideos] = useState([]);
  const [filter, setFilter] = useState("All");
  const [preview, setPreview] = useState(null);

  useEffect(()=>{
    api.get("/gallery").then(r=>setPhotos(r.data));
    api.get("/videos").then(r=>setVideos(r.data));
  },[]);

  const cats = ["All", ...new Set(photos.map(p=>p.category))];
  const shown = filter==="All"?photos:photos.filter(p=>p.category===filter);

  return (
    <div data-testid="gallery-page">
      <PageHero eyebrow="GALLERY" titleHi="गैलरी" titleEn="Gallery"
        subtitleHi="मंदिर, आरती, भंडारा एवं उत्सवों की झलक।" subtitleEn="Glimpses of the temple, aartis, bhandaras and festivals."
        image="https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1800&q=85"/>
      <section className="max-w-[1400px] mx-auto px-6 lg:px-10 py-16">
        <div className="flex flex-wrap gap-3 mb-10">
          {cats.map(c=>(
            <button key={c} onClick={()=>setFilter(c)} data-testid={`gallery-filter-${c}`}
              className={`px-4 py-2 rounded-full border text-xs uppercase tracking-widest transition ${filter===c?'bg-[#D4AF37] text-void border-transparent':'border-gold-soft text-ivory/85 hover:border-gold-strong'}`}>
              {c}
            </button>
          ))}
        </div>
        <div className="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
          {shown.map(p=>(
            <button key={p.id} onClick={()=>setPreview(p)} className="w-full text-left break-inside-avoid overflow-hidden rounded-lg border border-gold-soft hover:border-gold-strong transition group" data-testid={`gallery-item-${p.id}`}>
              <img src={p.image} alt="" className="w-full group-hover:scale-105 transition duration-500"/>
              <div className="p-3 text-sm text-ivory/85 bg-charcoal">{lang==='hi'?p.title_hi:p.title_en}</div>
            </button>
          ))}
        </div>
        <h2 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-3xl text-ivory mt-20 mb-8`}>{t("वीडियो गैलरी","Video Gallery")}</h2>
        <div className="grid md:grid-cols-3 gap-6" data-testid="video-gallery">
          {videos.map(v=>(
            <div key={v.id} className="card-sacred overflow-hidden">
              <div className="aspect-video">
                <iframe className="w-full h-full" src={`https://www.youtube.com/embed/${v.youtube_id}`} title={v.title_en} allowFullScreen/>
              </div>
              <div className="p-4">
                <div className="text-xs uppercase text-gold tracking-widest">{v.category}</div>
                <div className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-ivory mt-2`}>{lang==='hi'?v.title_hi:v.title_en}</div>
              </div>
            </div>
          ))}
        </div>
      </section>
      {preview && (
        <div className="fixed inset-0 bg-void/90 z-50 flex items-center justify-center p-6" onClick={()=>setPreview(null)} data-testid="lightbox">
          <button className="absolute top-6 right-6 text-ivory" onClick={()=>setPreview(null)}><X className="w-8 h-8"/></button>
          <img src={preview.image} alt="" className="max-h-[85vh] max-w-full rounded-lg border border-gold-strong"/>
        </div>
      )}
    </div>
  );
};
export default Gallery;
