import { PageHero, RichText } from "../components/PageHero";
import { SectionHeader } from "../components/Section";
import { useLang, useT } from "../lib/i18n";

const About = () => {
  const { lang } = useLang();
  const t = useT();
  const timeline = [
    { year: "स्थापना", en: "Foundation", hi_desc: "सिद्ध सन्निधम् की नींव भक्ति, सेवा एवं शनि साधना के भाव से रखी गई।", en_desc: "Siddh Sannidham was founded with the intent of devotion, seva and Shani sadhana." },
    { year: "मुख्य विग्रह", en: "Main Vigraha", hi_desc: "शनि देव के पावन विग्रह की प्राण प्रतिष्ठा।", en_desc: "Prana pratishtha of the sacred Shani Dev vigraha." },
    { year: "सेवा विस्तार", en: "Seva Expansion", hi_desc: "अन्न सेवा, गौ सेवा एवं सामुदायिक भंडारे का शुभारंभ।", en_desc: "Launch of anna seva, gau seva and community bhandaras." },
    { year: "आज", en: "Today", hi_desc: "देश एवं विदेश के भक्तों से जुड़ी एक जीवंत आध्यात्मिक साधना।", en_desc: "A living spiritual practice connecting devotees across India and abroad." },
  ];
  const sections = [
    ["हमारी कथा","Our Story","सिद्ध सन्निधम् की स्थापना उस भाव से हुई जिसमें भक्त शनि देव के सम्मुख अपनी सच्चाई एवं श्रद्धा को समर्पित कर सकें।","Siddh Sannidham was founded so that devotees could offer their sincerity and devotion before Shani Dev."],
    ["हमारा उद्देश्य","Our Purpose","शनि साधना, सेवा, अनुशासन एवं सामुदायिक कल्याण को जीवंत रखना।","Keeping alive Shani sadhana, seva, discipline and community welfare."],
    ["हमारी परंपराएँ","Our Traditions","प्रतिदिन की आरती, शनिवार विशेष पूजन, अमावस्या अनुष्ठान एवं सामुदायिक भंडारा।","Daily aarti, special Saturday pujan, Amavasya rituals and community bhandaras."],
    ["हमारा दृष्टिकोण","Our Vision","एक ऐसा पावन केंद्र जो श्रद्धा एवं सेवा में सर्वप्रथम रहे।","A sacred centre that stands first in devotion and seva."],
  ];
  return (
    <div data-testid="about-page">
      <PageHero eyebrow="ABOUT" titleHi="सिद्ध सन्निधम् का परिचय" titleEn="About Siddh Sannidham"
        subtitleHi="भक्ति, सेवा एवं शनि साधना का पावन केंद्र।" subtitleEn="A sacred centre of devotion, seva and Shani sadhana."
        image="https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20">
        <div className="grid md:grid-cols-2 gap-10">
          {sections.map(([hi,en,dhi,den],i)=>(
            <div key={i} className="card-sacred p-8" data-testid={`about-section-${i}`}>
              <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory mb-4`}>{t(hi,en)}</h3>
              <RichText hi={dhi} en={den}/>
            </div>
          ))}
        </div>
        <SectionHeader eyebrow="TIMELINE" titleHi="हमारी यात्रा" titleEn="Our Journey" lang={lang} />
        <div className="relative pl-6 border-l border-gold-soft space-y-10">
          {timeline.map((item,i)=>(
            <div key={i} className="relative" data-testid={`timeline-${i}`}>
              <span className="absolute -left-[31px] w-4 h-4 rounded-full bg-void border border-gold-strong" />
              <div className="text-gold text-sm uppercase tracking-widest">{lang==='hi'?item.year:item.en}</div>
              <p className={`${lang==='hi'?'font-body-hi':''} text-ivory/85 mt-2 leading-relaxed`}>{lang==='hi'?item.hi_desc:item.en_desc}</p>
            </div>
          ))}
        </div>
      </section>
    </div>
  );
};
export default About;
