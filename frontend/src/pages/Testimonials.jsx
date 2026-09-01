import { PageHero, RichText } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { toast } from "sonner";

const Testimonials = () => {
  const { lang } = useLang();
  const t = useT();
  const [items, setItems] = useState([]);
  const [form, setForm] = useState({ name:"", city:"", experience_en:"", experience_hi:"", date: new Date().toISOString().slice(0,10) });
  useEffect(()=>{ api.get("/testimonials").then(r=>setItems(r.data)); },[]);
  const submit = async e => {
    e.preventDefault();
    try {
      await api.post("/testimonials", form);
      toast.success(t("आपके अनुभव के लिए धन्यवाद।","Thank you for sharing your experience."));
      const r = await api.get("/testimonials"); setItems(r.data);
      setForm({ name:"", city:"", experience_en:"", experience_hi:"", date: new Date().toISOString().slice(0,10) });
    } catch { toast.error(t("त्रुटि हुई","Something went wrong")); }
  };
  return (
    <div data-testid="testimonials-page">
      <PageHero eyebrow="EXPERIENCES" titleHi="भक्तों के अनुभव" titleEn="Devotee Experiences"
        subtitleHi="सिद्ध सन्निधम् आने वाले भक्तों की श्रद्धांजलि।" subtitleEn="Reflections shared by devotees who visited Siddh Sannidham."
        image="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20">
        <div className="grid md:grid-cols-2 gap-6">
          {items.map(x=>(
            <div key={x.id} className="card-sacred p-6" data-testid={`testimonial-${x.id}`}>
              <div className={`${lang==='hi'?'font-body-hi':'font-serif-en italic'} text-ivory leading-relaxed`}>
                "{lang==='hi'?x.experience_hi:x.experience_en}"
              </div>
              <div className="mt-5 flex items-center justify-between">
                <div>
                  <div className="text-gold">{x.name}</div>
                  <div className="text-xs text-muted-ivory">{x.city} · {x.date}</div>
                </div>
                {x.verified && <span className="text-xs uppercase tracking-widest text-gold border border-gold-soft rounded-full px-2 py-1">{t("सत्यापित","Verified")}</span>}
              </div>
            </div>
          ))}
        </div>
        <form onSubmit={submit} className="card-sacred p-8 mt-16" data-testid="testimonial-form">
          <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory mb-6`}>{t("अपना अनुभव साझा करें","Share Your Experience")}</h3>
          <div className="grid sm:grid-cols-2 gap-4">
            <input required placeholder={t("नाम","Name")} value={form.name} onChange={e=>setForm({...form,name:e.target.value})} className="bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong" data-testid="tm-name"/>
            <input required placeholder={t("शहर","City")} value={form.city} onChange={e=>setForm({...form,city:e.target.value})} className="bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong" data-testid="tm-city"/>
          </div>
          <textarea rows={3} placeholder={t("आपका अनुभव (हिन्दी)","Your experience (Hindi)")} value={form.experience_hi} onChange={e=>setForm({...form,experience_hi:e.target.value})} className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 mt-4 font-body-hi text-ivory focus:outline-none focus:border-gold-strong" data-testid="tm-hi"/>
          <textarea rows={3} placeholder={t("आपका अनुभव (English)","Your experience (English)")} value={form.experience_en} onChange={e=>setForm({...form,experience_en:e.target.value})} className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 mt-4 text-ivory focus:outline-none focus:border-gold-strong" data-testid="tm-en"/>
          <button type="submit" className="btn-primary-gold mt-6" data-testid="tm-submit">{t("भेजें","Submit")}</button>
          <p className="text-xs text-muted-ivory mt-4">{t("असत्यापित चमत्कारी दावे स्वीकार नहीं किए जाते।","Unverifiable miracle claims will not be published as factual statements.")}</p>
        </form>
      </section>
    </div>
  );
};
export default Testimonials;
