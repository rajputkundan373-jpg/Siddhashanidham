import { PageHero } from "../components/PageHero";
import { useLang, useT } from "../lib/i18n";
import { useEffect, useState } from "react";
import { api } from "../lib/api";
import { useSearchParams } from "react-router-dom";
import { toast } from "sonner";
import { Copy, ShieldCheck } from "lucide-react";

const TIERS = [501, 1001, 2501, 5001, 11001];
const PURPOSES = [
  ["सामान्य मंदिर सेवा","General Temple Seva"],
  ["भंडारा सेवा","Bhandara Seva"],
  ["अन्नदान","Annadan"],
  ["विशेष पूजा","Special Puja"],
  ["मंदिर विकास","Temple Development"],
  ["अन्य सेवा","Other Seva"],
];

const Donate = () => {
  const { lang } = useLang();
  const t = useT();
  const [sp] = useSearchParams();
  const [temple, setTemple] = useState(null);
  const [amount, setAmount] = useState(Number(sp.get("amount")) || 1001);
  const [custom, setCustom] = useState("");
  const [purpose, setPurpose] = useState(sp.get("purpose") || "General Temple Seva");
  const [form, setForm] = useState({ name:"", email:"", mobile:"", pan:"", message:"", anonymous:false });
  const [submitting, setSubmitting] = useState(false);

  useEffect(()=>{ api.get("/temple-info").then(r=>setTemple(r.data)); },[]);

  const submit = async (e) => {
    e.preventDefault();
    const finalAmount = custom ? Number(custom) : amount;
    if (!finalAmount || finalAmount < 1) { toast.error(t("कृपया सही राशि दर्ज करें","Please enter a valid amount")); return; }
    setSubmitting(true);
    try {
      await api.post("/donations", { ...form, amount: finalAmount, purpose });
      toast.success(t("धन्यवाद। आपकी सेवा एवं श्रद्धा के लिए Siddh Sannidham परिवार आपका आभारी है।","Thank you. The Siddh Sannidham parivar is grateful for your seva and devotion."));
      setForm({ name:"", email:"", mobile:"", pan:"", message:"", anonymous:false });
      setCustom("");
    } catch { toast.error(t("त्रुटि हुई","Something went wrong")); }
    finally { setSubmitting(false); }
  };

  const copy = (val) => { navigator.clipboard.writeText(val); toast.success(t("कॉपी हो गया","Copied")); };

  return (
    <div data-testid="donate-page">
      <PageHero eyebrow="DONATE" titleHi="आपकी श्रद्धा, हमारी सेवा" titleEn="Your Devotion, Our Seva"
        subtitleHi="मंदिर, भंडारा एवं सेवा कार्यों में अपना योगदान दें।" subtitleEn="Contribute to the temple, bhandara and seva activities."
        image="https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1800&q=85"/>
      <section className="max-w-[1200px] mx-auto px-6 lg:px-10 py-20 grid lg:grid-cols-3 gap-10">
        <form onSubmit={submit} className="lg:col-span-2 card-sacred p-8" data-testid="donate-form">
          <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory mb-6`}>{t("दान का उद्देश्य","Purpose of Donation")}</h3>
          <div className="grid sm:grid-cols-2 gap-3 mb-8">
            {PURPOSES.map(([hi,en])=>(
              <button type="button" key={en} onClick={()=>setPurpose(en)} data-testid={`purpose-${en.replace(/\s+/g,'-').toLowerCase()}`}
                className={`text-left px-4 py-3 rounded-lg border text-sm transition ${purpose===en?'border-gold-strong bg-[#D4AF37]/10 text-gold':'border-gold-soft text-ivory/85 hover:border-gold-strong'}`}>
                {t(hi,en)}
              </button>
            ))}
          </div>
          <h3 className={`${lang==='hi'?'font-devanagari':'font-serif-en'} text-2xl text-ivory mb-6`}>{t("राशि","Amount")}</h3>
          <div className="grid grid-cols-3 md:grid-cols-5 gap-3 mb-4">
            {TIERS.map(a=>(
              <button key={a} type="button" onClick={()=>{setAmount(a);setCustom("");}}
                data-testid={`tier-${a}`}
                className={`py-3 rounded-full border text-sm font-serif-en transition ${amount===a && !custom?'bg-[#D4AF37] text-void border-transparent':'border-gold-soft text-ivory hover:border-gold-strong'}`}>
                ₹{a.toLocaleString('en-IN')}
              </button>
            ))}
          </div>
          <input type="number" min={1} value={custom} onChange={e=>setCustom(e.target.value)}
            placeholder={t("अन्य राशि दर्ज करें","Custom amount")}
            className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 mb-8 text-ivory focus:outline-none focus:border-gold-strong"
            data-testid="custom-amount"/>
          <div className="grid sm:grid-cols-2 gap-4">
            <input required placeholder={t("नाम","Name")} value={form.name} onChange={e=>setForm({...form,name:e.target.value})} data-testid="donor-name" className="bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
            <input required type="email" placeholder={t("ईमेल","Email")} value={form.email} onChange={e=>setForm({...form,email:e.target.value})} data-testid="donor-email" className="bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
            <input required placeholder={t("मोबाइल","Mobile")} value={form.mobile} onChange={e=>setForm({...form,mobile:e.target.value})} data-testid="donor-mobile" className="bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
            <input placeholder={t("PAN (वैकल्पिक)","PAN (optional)")} value={form.pan} onChange={e=>setForm({...form,pan:e.target.value})} data-testid="donor-pan" className="bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong"/>
          </div>
          <textarea placeholder={t("संदेश (वैकल्पिक)","Message (optional)")} value={form.message} onChange={e=>setForm({...form,message:e.target.value})}
            data-testid="donor-message" rows={3}
            className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 mt-4 text-ivory focus:outline-none focus:border-gold-strong"/>
          <label className="flex items-center gap-3 mt-4 text-sm text-muted-ivory">
            <input type="checkbox" checked={form.anonymous} onChange={e=>setForm({...form,anonymous:e.target.checked})} data-testid="donor-anonymous"/>
            {t("गुप्त दान (नाम प्रकट न करें)","Anonymous donation")}
          </label>
          <button type="submit" disabled={submitting} className="btn-primary-gold mt-8 w-full justify-center" data-testid="donate-submit">
            {submitting? t("जा रहा है...","Submitting...") : t(`₹${(custom||amount).toLocaleString('en-IN')} का दान संकल्प`, `Confirm ₹${(custom||amount).toLocaleString('en-IN')} Donation`)}
          </button>
          <p className="text-xs text-muted-ivory mt-4 flex items-center gap-2">
            <ShieldCheck className="w-4 h-4 text-gold"/> {t("भुगतान गेटवे शीघ्र सक्रिय किया जाएगा। तब तक आप UPI/बैंक विवरण का उपयोग कर सकते हैं।","Payment gateway is coming soon. Meanwhile, please use the UPI / bank details.")}
          </p>
        </form>

        <aside className="space-y-6">
          <div className="card-sacred p-6" data-testid="upi-card">
            <div className="text-xs uppercase tracking-widest text-gold mb-3">UPI</div>
            <div className="flex items-center justify-between gap-3">
              <span className="text-ivory font-serif-en break-all">{temple?.upi_id || "siddhsannidham@upi"}</span>
              <button onClick={()=>copy(temple?.upi_id||"siddhsannidham@upi")} className="text-gold hover:text-gold-light" data-testid="copy-upi"><Copy className="w-4 h-4"/></button>
            </div>
            <div className="mt-5 aspect-square rounded-lg border border-gold-soft flex items-center justify-center bg-void relative overflow-hidden">
              <img src={`https://api.qrserver.com/v1/create-qr-code/?data=upi://pay?pa=${encodeURIComponent(temple?.upi_id||'siddhsannidham@upi')}%26pn=Siddh+Sannidham&size=300x300&bgcolor=0B0C10&color=D4AF37`} alt="UPI QR" className="w-40 h-40"/>
            </div>
          </div>
          <div className="card-sacred p-6" data-testid="bank-card">
            <div className="text-xs uppercase tracking-widest text-gold mb-3">{t("बैंक विवरण","Bank Details")}</div>
            <ul className="text-sm text-ivory/85 space-y-2">
              <li><span className="text-muted-ivory">A/c:</span> {temple?.bank?.holder}</li>
              <li><span className="text-muted-ivory">Bank:</span> {temple?.bank?.name}</li>
              <li><span className="text-muted-ivory">A/c No.:</span> {temple?.bank?.account}</li>
              <li><span className="text-muted-ivory">IFSC:</span> {temple?.bank?.ifsc}</li>
            </ul>
          </div>
          <div className="card-sacred p-6" data-testid="where-goes">
            <div className="text-xs uppercase tracking-widest text-gold mb-3">{t("कहाँ जाता है योगदान","Where Your Contribution Goes")}</div>
            <ul className="text-sm text-ivory/85 space-y-3">
              <li>• {t("मंदिर संचालन एवं रखरखाव","Temple operations & upkeep")}</li>
              <li>• {t("भंडारा एवं अन्नदान","Bhandara & annadan")}</li>
              <li>• {t("गौ सेवा","Gau seva")}</li>
              <li>• {t("जरूरतमंद सहायता","Support for the needy")}</li>
            </ul>
          </div>
        </aside>
      </section>
    </div>
  );
};
export default Donate;
