import { useEffect, useState } from "react";
import { api, API } from "../lib/api";
import axios from "axios";
import { toast } from "sonner";
import { useT } from "../lib/i18n";

const Admin = () => {
  const t = useT();
  const [token, setToken] = useState(localStorage.getItem("ss_admin_token") || "");
  const [authed, setAuthed] = useState(false);
  const [tab, setTab] = useState("today");
  const [today, setToday] = useState({ day_en:"Saturday", day_hi:"शनिवार", special_note_en:"", special_note_hi:"", aarti_en:"", aarti_hi:"", puja_en:"", puja_hi:"", bhandara_en:"", bhandara_hi:"", special_event_en:"", special_event_hi:"" });
  const [event, setEvent] = useState({ title_en:"", title_hi:"", date:"", time:"", location:"", category:"Festival", description_en:"", description_hi:"", image:"" });
  const [donations, setDonations] = useState([]);
  const [contacts, setContacts] = useState([]);
  const [article, setArticle] = useState({ slug:"", title_en:"", title_hi:"", category:"", excerpt_en:"", excerpt_hi:"", content_en:"", content_hi:"", image:"", read_time:5 });

  const authHeaders = { headers: { "X-Admin-Token": token } };

  const login = async () => {
    try {
      await axios.get(`${API}/admin/donations`, authHeaders);
      localStorage.setItem("ss_admin_token", token);
      setAuthed(true);
      loadData();
      toast.success("Welcome, admin");
    } catch {
      toast.error("Invalid token");
    }
  };

  const loadData = async () => {
    const d = await axios.get(`${API}/admin/donations`, authHeaders); setDonations(d.data);
    const c = await axios.get(`${API}/admin/contacts`, authHeaders); setContacts(c.data);
    const today = await api.get("/today"); setToday(today.data.day_en ? today.data : today);
  };

  useEffect(()=>{ if (token) { login(); } }, []); // eslint-disable-line

  const saveToday = async () => {
    try { await axios.post(`${API}/admin/today`, today, authHeaders); toast.success("Today info updated"); }
    catch { toast.error("Failed"); }
  };
  const addEvent = async () => {
    try { await axios.post(`${API}/events`, event, authHeaders); toast.success("Event added"); setEvent({ title_en:"", title_hi:"", date:"", time:"", location:"", category:"Festival", description_en:"", description_hi:"", image:"" }); }
    catch { toast.error("Failed"); }
  };
  const addArticle = async () => {
    try { await axios.post(`${API}/articles`, article, authHeaders); toast.success("Article added"); setArticle({ slug:"", title_en:"", title_hi:"", category:"", excerpt_en:"", excerpt_hi:"", content_en:"", content_hi:"", image:"", read_time:5 }); }
    catch { toast.error("Failed"); }
  };

  if (!authed) {
    return (
      <div className="min-h-[80vh] flex items-center justify-center px-6" data-testid="admin-login">
        <div className="card-sacred p-8 w-full max-w-md">
          <h1 className="font-serif-en text-2xl text-ivory mb-2">Siddh Sannidham Admin</h1>
          <p className="text-muted-ivory text-sm mb-6">Enter admin token to manage the temple content.</p>
          <input type="password" value={token} onChange={e=>setToken(e.target.value)} placeholder="Admin token"
            className="w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-3 text-ivory focus:outline-none focus:border-gold-strong mb-4" data-testid="admin-token-input"/>
          <button onClick={login} className="btn-primary-gold w-full justify-center" data-testid="admin-login-btn">Login</button>
        </div>
      </div>
    );
  }

  const inp = "w-full bg-charcoal border border-gold-soft rounded-lg px-4 py-2.5 text-ivory focus:outline-none focus:border-gold-strong";

  return (
    <div className="max-w-[1400px] mx-auto px-6 lg:px-10 py-12" data-testid="admin-panel">
      <div className="flex items-center justify-between mb-8">
        <h1 className="font-serif-en text-3xl text-ivory">Admin Console</h1>
        <button onClick={()=>{localStorage.removeItem("ss_admin_token"); setAuthed(false); setToken("");}} className="btn-outline-gold !text-xs" data-testid="admin-logout">Logout</button>
      </div>
      <div className="flex flex-wrap gap-2 mb-8" data-testid="admin-tabs">
        {["today","events","articles","donations","contacts"].map(k=>(
          <button key={k} onClick={()=>setTab(k)} data-testid={`tab-${k}`} className={`px-4 py-2 rounded-full text-xs uppercase tracking-widest border ${tab===k?'bg-[#D4AF37] text-void border-transparent':'border-gold-soft text-ivory/85'}`}>{k}</button>
        ))}
      </div>

      {tab==="today" && (
        <div className="card-sacred p-8 space-y-3" data-testid="admin-today">
          <h2 className="font-serif-en text-xl text-ivory">Today at Temple</h2>
          {Object.keys(today).filter(k=>!["id","created_at"].includes(k)).map(k=>(
            <input key={k} className={inp} placeholder={k} value={today[k]||""} onChange={e=>setToday({...today,[k]:e.target.value})}/>
          ))}
          <button onClick={saveToday} className="btn-primary-gold" data-testid="save-today">Save</button>
        </div>
      )}

      {tab==="events" && (
        <div className="card-sacred p-8 space-y-3" data-testid="admin-events">
          <h2 className="font-serif-en text-xl text-ivory">Add Event</h2>
          {Object.keys(event).map(k=>(
            <input key={k} className={inp} placeholder={k} value={event[k]||""} onChange={e=>setEvent({...event,[k]:e.target.value})}/>
          ))}
          <button onClick={addEvent} className="btn-primary-gold" data-testid="save-event">Add Event</button>
        </div>
      )}

      {tab==="articles" && (
        <div className="card-sacred p-8 space-y-3" data-testid="admin-articles">
          <h2 className="font-serif-en text-xl text-ivory">Publish Article</h2>
          {Object.keys(article).map(k=>(
            k==="content_en"||k==="content_hi"
              ? <textarea key={k} rows={4} className={inp} placeholder={k} value={article[k]||""} onChange={e=>setArticle({...article,[k]:e.target.value})}/>
              : <input key={k} className={inp} placeholder={k} value={article[k]||""} onChange={e=>setArticle({...article,[k]:k==='read_time'?Number(e.target.value)||1:e.target.value})}/>
          ))}
          <button onClick={addArticle} className="btn-primary-gold" data-testid="save-article">Publish</button>
        </div>
      )}

      {tab==="donations" && (
        <div className="card-sacred p-8" data-testid="admin-donations">
          <h2 className="font-serif-en text-xl text-ivory mb-4">Donations ({donations.length})</h2>
          <div className="space-y-2 text-sm">
            {donations.map(d=>(
              <div key={d.id} className="border border-gold-soft rounded-lg p-3 flex flex-wrap justify-between gap-2">
                <span className="text-ivory">{d.anonymous?"Anonymous":d.name}</span>
                <span className="text-muted-ivory">{d.purpose}</span>
                <span className="text-gold">₹{d.amount.toLocaleString('en-IN')}</span>
                <span className="text-muted-ivory">{d.created_at?.slice(0,10)}</span>
              </div>
            ))}
          </div>
        </div>
      )}

      {tab==="contacts" && (
        <div className="card-sacred p-8" data-testid="admin-contacts">
          <h2 className="font-serif-en text-xl text-ivory mb-4">Contact Messages ({contacts.length})</h2>
          <div className="space-y-3 text-sm">
            {contacts.map(c=>(
              <div key={c.id} className="border border-gold-soft rounded-lg p-4">
                <div className="text-gold">{c.name} · {c.mobile}</div>
                <div className="text-muted-ivory text-xs">{c.email} · {c.created_at?.slice(0,10)}</div>
                <div className="text-ivory mt-2">{c.message}</div>
              </div>
            ))}
          </div>
        </div>
      )}
    </div>
  );
};
export default Admin;
