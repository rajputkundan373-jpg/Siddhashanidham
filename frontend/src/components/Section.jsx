export const SectionHeader = ({ eyebrow, titleHi, titleEn, subtitle, lang, align = "left" }) => (
  <div className={`mb-12 ${align === "center" ? "text-center mx-auto max-w-3xl" : "max-w-3xl"}`}>
    {eyebrow && <div className="text-xs uppercase tracking-[0.32em] text-gold mb-4">{eyebrow}</div>}
    <h2 className="text-3xl sm:text-4xl lg:text-5xl leading-tight">
      {lang === "hi" ? <span className="font-devanagari text-ivory">{titleHi}</span> : <span className="font-serif-en text-ivory">{titleEn}</span>}
    </h2>
    <div className={`gold-underline mt-5 ${align === "center" ? "mx-auto" : ""}`} />
    {subtitle && <p className={`${lang === "hi" ? "font-body-hi" : ""} text-muted-ivory mt-5 text-base leading-relaxed`}>{subtitle}</p>}
  </div>
);

export const Ornament = () => (
  <div className="flex items-center justify-center gap-3 my-8" aria-hidden>
    <span className="h-px w-16 bg-gradient-to-r from-transparent to-[#D4AF37]/60" />
    <span className="text-gold text-lg">◈</span>
    <span className="h-px w-16 bg-gradient-to-l from-transparent to-[#D4AF37]/60" />
  </div>
);
