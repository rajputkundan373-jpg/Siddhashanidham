import { useLang, useT } from "../lib/i18n";
import { SectionHeader } from "../components/Section";

export const PageHero = ({ eyebrow, titleHi, titleEn, subtitleHi, subtitleEn, image }) => {
  const { lang } = useLang();
  const t = useT();
  return (
    <section className="relative min-h-[52vh] overflow-hidden grain-overlay" data-testid="page-hero">
      <div className="absolute inset-0">
        <img src={image} alt="" className="w-full h-full object-cover opacity-50"/>
        <div className="absolute inset-0 bg-gradient-to-b from-void/60 via-void/50 to-void"/>
      </div>
      <div className="relative max-w-[1400px] mx-auto px-6 lg:px-10 pt-24 pb-16">
        {eyebrow && <div className="text-xs uppercase tracking-[0.32em] text-gold mb-4">{eyebrow}</div>}
        <h1 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-4xl sm:text-5xl lg:text-6xl text-ivory leading-tight max-w-3xl`}>
          {lang==='hi'?titleHi:titleEn}
        </h1>
        {(subtitleHi || subtitleEn) && (
          <p className={`${lang==='hi'?'font-body-hi':'font-serif-en italic'} text-muted-ivory mt-5 max-w-2xl text-lg`}>
            {lang==='hi'?subtitleHi:subtitleEn}
          </p>
        )}
        <div className="gold-underline mt-6" />
      </div>
    </section>
  );
};

export const RichText = ({ hi, en }) => {
  const { lang } = useLang();
  return <p className={`${lang==='hi'?'font-body-hi':''} text-ivory/85 leading-[1.9] text-lg`}>{lang==='hi'?hi:en}</p>;
};
