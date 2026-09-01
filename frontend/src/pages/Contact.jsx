import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useState } from "react";
import { api } from "../lib/api";
import { toast } from "sonner";
import { Phone, Mail, MessageCircle, MapPin } from "lucide-react";

const Contact = () => {
  const { lang } = useLang();
  const t = useT();
  const [form, setForm] = useState({ name:"", email:"", mobile:"", message:"" });
  const submit = async e => {
    e.preventDefault();
    try {
      await api.post("/contact", form);
      toast.success(t("आपका संदेश प्राप्त हो गया।","Your message has been received."));
      setForm({ name:"", email:"", mobile:"", message:"" });
    } catch { toast.error(t("त्रुटि हुई","Something went wrong")); }
  };
  return (
    <div data-testid="contact-page">
      <PageHero eyebrow="CONTACT" titleHi="संपर्क सिद्ध सन्निधम्" titleEn="Contact Siddh Sannidham"
        subtitleHi="हम आपसे सुनना चाहेंगे।" subtitleEn="We would love to hear from you."
        image="https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20 grid lg:grid-cols-2 gap-10">
        <form onSubmit={submit} className="card-sacred p-8" data-testid="contact-form">
          <h2 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory mb-6`}>{t("संदेश भेजें","Send a Message")}</h2>
          <div className="space-y-4">
            <input required value={form.name} onChange={e=>setForm({...form,name:e.target.value})} placeholder={t("नाम","Name")} data-testid="c-name" className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
            <input required value={form.mobile} onChange={e=>setForm({...form,mobile:e.target.value})} placeholder={t("मोबाइल","Mobile")} data-testid="c-mobile" className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
            <input required type="email" value={form.email} onChange={e=>setForm({...form,email:e.target.value})} placeholder={t("ईमेल","Email")} data-testid="c-email" className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
            <textarea required rows={5} value={form.message} onChange={e=>setForm({...form,message:e.target.value})} placeholder={t("संदेश","Message")} data-testid="c-message" className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
          </div>
          <button type="submit" className="btn-primary-gold mt-6" data-testid="c-submit">{t("भेजें","Send Message")}</button>
        </form>
        <div className="space-y-6">
          {[
            [MapPin, t("पता","Address"), "इटावा-ग्वालियर मार्ग, मध्य प्रदेश, भारत", "Etawa–Gwalior Road, Madhya Pradesh, India"],
            [Phone, t("फ़ोन","Phone"), "+91 98XXX XXXXX", "+91 98XXX XXXXX"],
            [MessageCircle, "WhatsApp", "+91 99999 99999", "+91 99999 99999"],
            [Mail, t("ईमेल","Email"), "seva@siddhsannidham.org", "seva@siddhsannidham.org"],
          ].map(([Icon,label,hi,en],i)=>(
            <div key={i} className="card-sacred p-5 flex items-start gap-4" data-testid={`c-info-${i}`}>
              <Icon className="w-5 h-5 text-gold mt-1"/>
              <div>
                <div className="text-xs uppercase tracking-widest text-gold">{label}</div>
                <div className="text-ivory mt-1">{lang==='hi'?hi:en}</div>
              </div>
            </div>
          ))}
          <a href="https://wa.me/919999999999" target="_blank" rel="noreferrer" className="btn-primary-gold w-full justify-center" data-testid="c-whatsapp">
            <MessageCircle className="w-4 h-4"/> {t("WhatsApp पर संपर्क करें","Contact on WhatsApp")}
          </a>
        </div>
      </section>
    </div>
  );
};
export default Contact;
