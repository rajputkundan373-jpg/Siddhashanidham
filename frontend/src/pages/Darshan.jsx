import { PageHero, RichText } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { MapPin, Camera, Clock } from "lucide-react";

const Darshan = () => {
  const { lang } = useLang();
  const t = useT();
  const timings = [
    ["प्रातः","Morning","05:00 AM – 12:30 PM"],
    ["दोपहर","Afternoon","04:00 PM – 09:30 PM"],
    ["शनिवार विशेष","Saturday Special","04:30 AM – 10:30 PM"],
  ];
  const guidelines = [
    ["स्वच्छ वस्त्र धारण करें","Wear clean, modest attire","गर्भगृह में मौन बनाए रखें","Maintain silence within the sanctum"],
    ["चरण-पादुका बाहर उतारें","Remove footwear at entry","पंक्ति एवं व्यवस्था का पालन करें","Follow queues and staff directions"],
    ["तेल एवं तिल शनि देव को अर्पित करें","Offer mustard oil & sesame to Shani Dev","प्रसाद को श्रद्धा से ग्रहण करें","Receive prasad with reverence"],
  ];
  return (
    <div data-testid="darshan-page">
      <PageHero eyebrow="DARSHAN" titleHi="दर्शन" titleEn="Darshan"
        subtitleHi="शनि देव के पावन दर्शन का समय एवं मार्गदर्शन।" subtitleEn="Timings and guidance for darshan of Shani Dev."
        image="https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20 grid lg:grid-cols-3 gap-6">
        {timings.map(([hi,en,time],i)=>(
          <div key={i} className="card-sacred p-8 text-center" data-testid={`darshan-time-${i}`}>
            <Clock className="w-6 h-6 text-gold mx-auto mb-4"/>
            <div className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory`}>{t(hi,en)}</div>
            <div className="text-gold mt-3 font-serif-en">{time}</div>
          </div>
        ))}
      </section>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 pb-20">
        <h2 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-3xl text-ivory mb-8`}>{t("दर्शन दिशानिर्देश","Darshan Guidelines")}</h2>
        <div className="grid md:grid-cols-2 gap-4">
          {guidelines.flatMap((g,i)=>[
            <div key={`a-${i}`} className="card-sacred p-5 flex items-start gap-3" data-testid={`guideline-a-${i}`}>
              <Camera className="w-4 h-4 text-gold mt-1"/>
              <span className={lang==='hi'?'font-body-hi text-ivory/90':'text-ivory/90'}>{lang==='hi'?g[0]:g[1]}</span>
            </div>,
            <div key={`b-${i}`} className="card-sacred p-5 flex items-start gap-3" data-testid={`guideline-b-${i}`}>
              <Camera className="w-4 h-4 text-gold mt-1"/>
              <span className={lang==='hi'?'font-body-hi text-ivory/90':'text-ivory/90'}>{lang==='hi'?g[2]:g[3]}</span>
            </div>
          ])}
        </div>
        <div className="mt-10 text-center">
          <a href="https://maps.google.com/?q=Etawa+Gwalior+Road+Madhya+Pradesh" target="_blank" rel="noreferrer" className="btn-primary-gold inline-flex" data-testid="darshan-directions">
            <MapPin className="w-4 h-4"/> {t("मार्गदर्शन प्राप्त करें","Get Directions")}
          </a>
        </div>
      </section>
    </div>
  );
};
export default Darshan;
