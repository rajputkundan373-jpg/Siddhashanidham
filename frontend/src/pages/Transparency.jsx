import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";

const Transparency = () => {
  const { lang } = useLang();
  const t = useT();
  const items = [
    ["दान का उपयोग","Donation Usage","सभी दान मंदिर संचालन, भंडारा एवं सेवा कार्यों में उपयोग होता है।","All donations are used for temple operations, bhandara and seva."],
    ["सेवा गतिविधियाँ","Seva Activities","अन्न सेवा, गौ सेवा एवं जरूरतमंद सहायता।","Anna seva, gau seva and support for the needy."],
    ["भंडारा गतिविधियाँ","Bhandara Activities","शनिवार, अमावस्या एवं विशेष तिथियों पर।","Held on Saturdays, Amavasya and special dates."],
    ["वार्षिक रिपोर्ट","Annual Updates","विस्तृत वित्तीय एवं सेवा रिपोर्ट शीघ्र।","Detailed financial & seva reports coming soon."],
  ];
  return (
    <div data-testid="transparency-page">
      <PageHero eyebrow="TRANSPARENCY" titleHi="पारदर्शिता" titleEn="Temple Transparency"
        subtitleHi="भक्तों के प्रति हमारा उत्तरदायित्व।" subtitleEn="Our accountability to our devotees."
        image="https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20 grid md:grid-cols-2 gap-6">
        {items.map(([hi,en,dhi,den],i)=>(
          <div key={i} className="card-sacred p-8" data-testid={`transparency-${i}`}>
            <div className="text-xs uppercase tracking-widest text-gold">{t(hi,en)}</div>
            <p className={`${lang==='hi'?'font-body-hi':''} text-ivory/85 mt-4 leading-relaxed`}>{t(dhi,den)}</p>
          </div>
        ))}
        <div className="md:col-span-2 text-center mt-8 text-sm text-muted-ivory">
          {t("वित्तीय आँकड़े शीघ्र प्रकाशित किए जाएंगे — कोई भी जानकारी बिना सत्यापन के प्रस्तुत नहीं की जाएगी।","Financial figures will be published as soon as verified — no unverified claim is presented here.")}
        </div>
      </section>
    </div>
  );
};
export default Transparency;
