import { Link } from "react-router-dom";
import { Youtube, Instagram, Facebook, MessageCircle, Mail, MapPin, Phone } from "lucide-react";
import { useState } from "react";
import { useT } from "../lib/i18n";
import { api } from "../lib/api";
import { toast } from "sonner";

const Footer = () => {
  const t = useT();
  const [email, setEmail] = useState("");
  const submit = async (e) => {
    e.preventDefault();
    try {
      await api.post("/newsletter", { email });
      toast.success(t("आपका आभार — जुड़ने के लिए धन्यवाद।","Thank you for subscribing."));
      setEmail("");
    } catch { toast.error(t("त्रुटि हुई","Something went wrong")); }
  };

  return (
    <footer className="relative bg-void border-t border-gold-soft mt-24" data-testid="site-footer">
      <div className="divider-gold" />
      <div className="max-w-[1400px] mx-auto px-6 lg:px-10 py-16">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          <div>
            <div className="font-devanagari text-2xl text-gold">सिद्ध सन्निधम्</div>
            <div className="font-serif-en text-xs tracking-[0.32em] text-muted-ivory mt-1">SIDDH SANNIDHAM</div>
            <p className="font-mantra text-gold-light mt-6 text-sm leading-loose">
              श्री शनिदेव की कृपा एवं आशीर्वाद
            </p>
            <p className="text-muted-ivory text-sm mt-4 leading-relaxed">
              {t("इटावा-ग्वालियर मार्ग पर स्थित एक पावन शनि धाम — दर्शन, सेवा एवं भक्ति का सिद्ध स्थान।",
                 "A sacred Shani Dham on Etawa–Gwalior Road — a place of darshan, seva and unwavering devotion.")}
            </p>
          </div>

          <div>
            <div className="text-xs uppercase tracking-[0.24em] text-gold mb-5">{t("त्वरित लिंक","Quick Links")}</div>
            <ul className="space-y-3 text-sm text-ivory/85">
              {[["/darshan","दर्शन","Darshan"],["/live-aarti","लाइव आरती","Live Aarti"],["/seva","सेवा","Seva"],["/donate","दान","Donate"],["/bhandara","भंडारा","Bhandara"],["/events","आयोजन","Events"],["/journal","जर्नल","Journal"],["/gallery","गैलरी","Gallery"],["/visit-us","यात्रा","Visit Us"],["/contact","संपर्क","Contact"]].map(([p,hi,en]) =>
                <li key={p}><Link to={p} className="hover:text-gold transition" data-testid={`footer-link-${p.slice(1)}`}>{t(hi,en)}</Link></li>
              )}
            </ul>
          </div>

          <div>
            <div className="text-xs uppercase tracking-[0.24em] text-gold mb-5">{t("संपर्क","Reach Us")}</div>
            <ul className="space-y-4 text-sm text-ivory/80">
              <li className="flex items-start gap-3"><MapPin className="w-4 h-4 text-gold mt-1"/><span>{t("इटावा-ग्वालियर मार्ग, मध्य प्रदेश","Etawa–Gwalior Road, Madhya Pradesh")}</span></li>
              <li className="flex items-center gap-3"><Phone className="w-4 h-4 text-gold"/><span>+91 98XXX XXXXX</span></li>
              <li className="flex items-center gap-3"><Mail className="w-4 h-4 text-gold"/><span>seva@siddhsannidham.org</span></li>
            </ul>
            <div className="flex items-center gap-3 mt-6">
              <a href="#" className="p-2 border border-gold-soft rounded-full hover:border-gold-strong hover:text-gold transition" data-testid="social-youtube"><Youtube className="w-4 h-4"/></a>
              <a href="#" className="p-2 border border-gold-soft rounded-full hover:border-gold-strong hover:text-gold transition" data-testid="social-instagram"><Instagram className="w-4 h-4"/></a>
              <a href="#" className="p-2 border border-gold-soft rounded-full hover:border-gold-strong hover:text-gold transition" data-testid="social-facebook"><Facebook className="w-4 h-4"/></a>
              <a href="#" className="p-2 border border-gold-soft rounded-full hover:border-gold-strong hover:text-gold transition" data-testid="social-whatsapp"><MessageCircle className="w-4 h-4"/></a>
            </div>
          </div>

          <div>
            <div className="text-xs uppercase tracking-[0.24em] text-gold mb-5">{t("समाचार पत्रिका","Newsletter")}</div>
            <p className="text-sm text-muted-ivory leading-relaxed mb-4">
              {t("मंदिर की सूचनाएँ, आयोजन एवं आध्यात्मिक लेख प्राप्त करें।","Receive temple updates, events and spiritual articles.")}
            </p>
            <form onSubmit={submit} className="flex flex-col gap-3" data-testid="newsletter-form">
              <input type="email" required value={email} onChange={e=>setEmail(e.target.value)}
                placeholder={t("आपका ईमेल","Your email")}
                className="bg-charcoal border border-gold-soft rounded-full px-4 py-2.5 text-sm focus:outline-none focus:border-gold-strong"
                data-testid="newsletter-email" />
              <button type="submit" className="btn-primary-gold !py-2.5 !text-xs" data-testid="newsletter-submit">
                {t("जुड़ें","Subscribe")}
              </button>
            </form>
          </div>
        </div>

        <div className="divider-gold mt-12" />
        <div className="flex flex-col md:flex-row justify-between items-center gap-4 pt-6 text-xs text-muted-ivory">
          <div>© {new Date().getFullYear()} Siddh Sannidham. {t("सर्वाधिकार सुरक्षित।","All Rights Reserved.")}</div>
          <div className="flex gap-6 flex-wrap">
            <a href="#" className="hover:text-gold">{t("गोपनीयता नीति","Privacy Policy")}</a>
            <a href="#" className="hover:text-gold">{t("शर्तें","Terms")}</a>
            <a href="#" className="hover:text-gold">{t("दान नीति","Donation Policy")}</a>
            <a href="#" className="hover:text-gold">{t("अस्वीकरण","Disclaimer")}</a>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
