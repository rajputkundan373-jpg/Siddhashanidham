import { PageHero, RichText } from "../components/PageHero";
import { SectionHeader, Ornament } from "../components/Section";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { Link } from "react-router-dom";

const ShaniDev = () => {
  const { lang } = useLang();
  const t = useT();
  const [articles, setArticles] = useState([]);
  useEffect(()=>{ api.get("/articles").then(r=>setArticles(r.data.slice(0,4))); },[]);
  const topics = [
    ["शनि देव कौन हैं?","Who is Shani Dev?","सूर्य पुत्र, कर्म फल के देवता।","Son of Surya, giver of the fruits of karma."],
    ["शनि देव और कर्म","Shani Dev & Karma","जैसा कर्म, वैसा फल।","As is the karma, so is the fruit."],
    ["शनि देव के मंत्र","Shani Mantras","शनि बीज मंत्र एवं गायत्री मंत्र।","Shani Beej Mantra and Gayatri Mantra."],
    ["शनिवार पूजन","Saturday Worship","विधिवत शनिवार पूजा एवं व्रत।","Traditional Saturday puja and vrat."],
    ["शनि जयंती","Shani Jayanti","शनि देव के प्राकट्य दिवस का उत्सव।","Celebration of Shani Dev's appearance day."],
    ["शनि अमावस्या","Shani Amavasya","विशेष अमावस्या अनुष्ठान।","Special Amavasya rituals."],
  ];
  const faqs = [
    ["शनि देव क्या न्याय करते हैं?","What does Shani Dev symbolise?","हाँ — वे कर्मों के न्यायपूर्ण दृष्टा हैं।","Yes — he is the just observer of one's karmas."],
    ["शनिवार को क्या करना शुभ है?","What is auspicious on Saturday?","सत्संग, दान, सेवा एवं सरसों के तेल का दीप।","Satsang, daan, seva and a mustard-oil diya."],
  ];
  return (
    <div data-testid="shani-page">
      <PageHero eyebrow="SHANI DEV" titleHi="शनि देव — न्याय, कर्म एवं अनुशासन" titleEn="Shani Dev — Justice, Karma & Discipline"
        subtitleHi="ॐ नीलांजनसमाभासं रविपुत्रं यमाग्रजम् ।" subtitleEn="Son of Surya, the deity of karma in Hindu tradition."
        image="https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20">
        <RichText hi="शनि देव सूर्य पुत्र हैं और हिन्दू परंपरा में कर्मफल के देवता माने जाते हैं। उनकी आराधना श्रद्धा, अनुशासन एवं सत्य के साथ की जाती है।"
          en="Shani Dev is the son of Surya and, in the Hindu tradition, is revered as the deity of karma. His worship is performed with devotion, discipline and truth."/>
        <SectionHeader eyebrow={t("शिक्षा","Learning")} titleHi="ज्ञान केंद्र" titleEn="Knowledge Center" lang={lang} />
        <div className="grid md:grid-cols-2 gap-6">
          {topics.map(([hi,en,dhi,den],i)=>(
            <div key={i} className="card-sacred p-6" data-testid={`topic-${i}`}>
              <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-xl text-gold mb-2`}>{t(hi,en)}</h3>
              <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory`}>{t(dhi,den)}</p>
            </div>
          ))}
        </div>
        <Ornament/>
        <SectionHeader eyebrow={t("लेख","Articles")} titleHi="अनुशंसित पठन" titleEn="Recommended Reading" lang={lang} />
        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          {articles.map(a=>(
            <Link key={a.id} to={`/journal/${a.slug}`} className="card-sacred overflow-hidden group" data-testid={`article-${a.slug}`}>
              <img src={a.image} alt="" className="h-40 w-full object-cover group-hover:scale-105 transition"/>
              <div className="p-5">
                <div className="text-xs uppercase text-gold tracking-widest">{a.category}</div>
                <h4 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-ivory mt-2`}>{lang==='hi'?a.title_hi:a.title_en}</h4>
              </div>
            </Link>
          ))}
        </div>
        <Ornament/>
        <SectionHeader eyebrow="FAQ" titleHi="प्रश्नोत्तर" titleEn="Frequently Asked" lang={lang} />
        <div className="space-y-4">
          {faqs.map(([qhi,qen,ahi,aen],i)=>(
            <details key={i} className="card-sacred p-5 group" data-testid={`faq-${i}`}>
              <summary className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-ivory cursor-pointer list-none flex justify-between items-center`}>
                {t(qhi,qen)} <span className="text-gold group-open:rotate-45 transition">+</span>
              </summary>
              <p className={`${lang==='hi'?'font-body-hi':''} text-muted-ivory mt-3`}>{t(ahi,aen)}</p>
            </details>
          ))}
        </div>
      </section>
    </div>
  );
};
export default ShaniDev;
