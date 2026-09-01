import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { Link, useParams } from "react-router-dom";
import { Clock, ArrowLeft } from "lucide-react";

export const Journal = () => {
  const { lang } = useLang();
  const t = useT();
  const [articles, setArticles] = useState([]);
  const [q, setQ] = useState("");
  useEffect(()=>{ api.get("/articles").then(r=>setArticles(r.data)); },[]);
  const shown = articles.filter(a=>{
    const hay = `${a.title_en} ${a.title_hi} ${a.category}`.toLowerCase();
    return hay.includes(q.toLowerCase());
  });
  const featured = shown[0];
  const rest = shown.slice(1);
  return (
    <div data-testid="journal-page">
      <PageHero eyebrow="JOURNAL" titleHi="सिद्ध सन्निधम् जर्नल" titleEn="Siddh Sannidham Journal"
        subtitleHi="आध्यात्मिक ज्ञान, शनि साधना एवं मंदिर परंपरा पर लेख।" subtitleEn="Essays on spiritual wisdom, Shani sadhana and temple traditions."
        image="https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-16">
        <input value={q} onChange={e=>setQ(e.target.value)} placeholder={t("लेख खोजें...","Search articles...")}
          className="w-full bg-charcoal border border-gold-soft rounded-full px-6 py-3 text-ivory mb-12 focus:outline-none focus:border-gold-strong" data-testid="journal-search"/>
        {featured && (
          <Link to={`/journal/${featured.slug}`} className="grid md:grid-cols-2 gap-8 mb-16 card-sacred overflow-hidden group" data-testid="journal-featured">
            <img src={featured.image} alt="" className="w-full h-full object-cover min-h-[280px] group-hover:scale-105 transition"/>
            <div className="p-8 flex flex-col justify-center">
              <div className="text-xs uppercase tracking-widest text-gold">{featured.category} · {t("मुख्य","Featured")}</div>
              <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-3xl text-ivory mt-3`}>{lang==='hi'?featured.title_hi:featured.title_en}</h3>
              <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory mt-4`}>{lang==='hi'?featured.excerpt_hi:featured.excerpt_en}</p>
              <div className="flex items-center gap-2 text-xs text-muted-ivory mt-4"><Clock className="w-3 h-3"/> {featured.read_time} {t("मिनट","min")}</div>
            </div>
          </Link>
        )}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
          {rest.map(a=>(
            <Link key={a.id} to={`/journal/${a.slug}`} className="card-sacred overflow-hidden group" data-testid={`journal-${a.slug}`}>
              <img src={a.image} alt="" className="h-48 w-full object-cover group-hover:scale-105 transition"/>
              <div className="p-5">
                <div className="text-xs uppercase text-gold tracking-widest">{a.category}</div>
                <h4 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-xl text-ivory mt-2`}>{lang==='hi'?a.title_hi:a.title_en}</h4>
                <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory text-sm mt-2`}>{lang==='hi'?a.excerpt_hi:a.excerpt_en}</p>
              </div>
            </Link>
          ))}
        </div>
      </section>
    </div>
  );
};

export const ArticleDetail = () => {
  const { lang } = useLang();
  const t = useT();
  const { slug } = useParams();
  const [a, setA] = useState(null);
  useEffect(()=>{ api.get(`/articles/${slug}`).then(r=>setA(r.data)); },[slug]);
  if (!a) return <div className="min-h-[60vh] flex items-center justify-center text-muted-ivory">{t("लोड हो रहा है...","Loading...")}</div>;
  return (
    <article className="max-w-3xl mx-auto px-6 lg:px-10 py-20" data-testid="article-detail">
      <Link to="/journal" className="inline-flex items-center gap-2 text-gold text-sm mb-8"><ArrowLeft className="w-4 h-4"/> {t("जर्नल","Journal")}</Link>
      <div className="text-xs uppercase tracking-widest text-gold mb-4">{a.category}</div>
      <h1 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-4xl lg:text-5xl text-ivory leading-tight`}>{lang==='hi'?a.title_hi:a.title_en}</h1>
      <div className="flex items-center gap-4 text-sm text-muted-ivory mt-4">
        <span>{a.author}</span><span>·</span><span>{a.read_time} {t("मिनट","min")}</span>
      </div>
      <img src={a.image} alt="" className="w-full h-72 object-cover rounded-lg my-10 border border-gold-soft"/>
      <div className={`${lang==='hi'?'font-body-hi':''} text-ivory/85 leading-[1.9] text-lg space-y-6`}>
        {(lang==='hi'?a.content_hi:a.content_en).split('\n').map((p,i)=>(<p key={i}>{p}</p>))}
      </div>
    </article>
  );
};
