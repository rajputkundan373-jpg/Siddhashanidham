import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { MapPin, Plane, Train, Bus, Car, Phone, MessageCircle } from "lucide-react";

const VisitUs = () => {
  const { lang } = useLang();
  const t = useT();
  const info = [
    [Plane, "निकटतम हवाई अड्डा","Nearest Airport","ग्वालियर (GWL) — लगभग 65 किमी","Gwalior (GWL) — approx. 65 km"],
    [Train, "रेलवे स्टेशन","Railway Station","इटावा एवं ग्वालियर","Etawah & Gwalior"],
    [Bus, "बस स्टैंड","Bus Stand","स्थानीय एवं राज्य परिवहन","Local & state transport"],
    [Car, "सड़क","Road","इटावा-ग्वालियर राजमार्ग","Etawa–Gwalior highway"],
  ];
  const steps = [
    ["यात्रा की तिथि तय करें","Decide your visit date"],
    ["मौसम एवं शनिवार का ध्यान रखें","Check weather & Saturday timings"],
    ["ठहरने की व्यवस्था करें","Arrange accommodation"],
    ["मंदिर के दर्शन एवं आरती में सम्मिलित हों","Attend darshan & aarti"],
  ];
  return (
    <div data-testid="visit-page">
      <PageHero eyebrow="VISIT" titleHi="यात्रा योजना" titleEn="Plan Your Visit"
        subtitleHi="इटावा-ग्वालियर मार्ग, मध्य प्रदेश।" subtitleEn="Etawa–Gwalior Road, Madhya Pradesh."
        image="https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20">
        <div className="grid lg:grid-cols-2 gap-10">
          <div>
            <h2 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-3xl text-ivory mb-6`}>{t("कैसे पहुँचें","How to Reach")}</h2>
            <div className="space-y-4">
              {info.map(([Icon,hi,en,dhi,den],i)=>(
                <div key={i} className="card-sacred p-5 flex gap-4" data-testid={`reach-${i}`}>
                  <Icon className="w-5 h-5 text-gold mt-1"/>
                  <div>
                    <div className={`${lang==='hi'?'font-body-hi':''} text-gold text-sm`}>{t(hi,en)}</div>
                    <div className={`${lang==='hi'?'font-body-hi':''} text-ivory mt-1`}>{t(dhi,den)}</div>
                  </div>
                </div>
              ))}
            </div>
          </div>
          <div className="card-sacred p-6" data-testid="map-embed">
            <div className="aspect-square lg:aspect-[4/3] rounded-lg overflow-hidden border border-gold-soft">
              <iframe title="map" className="w-full h-full grayscale contrast-125" src="https://www.google.com/maps?q=Etawa+Gwalior+Road+Madhya+Pradesh&output=embed"/>
            </div>
            <div className="flex flex-wrap gap-3 mt-6">
              <a href="https://maps.google.com/?q=Etawa+Gwalior+Road+Madhya+Pradesh" target="_blank" rel="noreferrer" className="btn-primary-gold !text-xs" data-testid="get-directions"><MapPin className="w-4 h-4"/>{t("दिशा-निर्देश","Directions")}</a>
              <a href="https://wa.me/919999999999" target="_blank" rel="noreferrer" className="btn-outline-gold !text-xs" data-testid="whatsapp-visit"><MessageCircle className="w-4 h-4"/>WhatsApp</a>
              <a href="tel:+919999999999" className="btn-outline-gold !text-xs"><Phone className="w-4 h-4"/>{t("कॉल","Call")}</a>
            </div>
          </div>
        </div>
        <h2 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-3xl text-ivory mt-16 mb-8`}>{t("यात्रा के चरण","Visit Steps")}</h2>
        <div className="grid md:grid-cols-4 gap-6">
          {steps.map(([hi,en],i)=>(
            <div key={i} className="card-sacred p-6" data-testid={`step-${i}`}>
              <div className="text-gold font-serif-en text-3xl">0{i+1}</div>
              <div className={`${lang==='hi'?'font-body-hi':''} text-ivory mt-3`}>{t(hi,en)}</div>
            </div>
          ))}
        </div>
      </section>
    </div>
  );
};
export default VisitUs;
