import { createContext, useContext, useEffect, useState } from "react";

const I18nContext = createContext({ lang: "hi", setLang: () => {} });

export const I18nProvider = ({ children }) => {
  const [lang, setLang] = useState(() => localStorage.getItem("ss_lang") || "hi");
  useEffect(() => { localStorage.setItem("ss_lang", lang); }, [lang]);
  return (
    <I18nContext.Provider value={{ lang, setLang }}>{children}</I18nContext.Provider>
  );
};

export const useLang = () => useContext(I18nContext);

// simple translation resolver: t(hi, en) or t({hi, en})
export const useT = () => {
  const { lang } = useLang();
  return (hi, en) => (lang === "hi" ? hi : en);
};

export const pick = (lang, obj, key) => obj?.[`${key}_${lang}`] ?? obj?.[`${key}_en`] ?? "";
