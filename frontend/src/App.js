import { BrowserRouter, Routes, Route } from "react-router-dom";
import { Toaster } from "sonner";
import { I18nProvider } from "./lib/i18n";
import Navbar from "./components/Navbar";
import Footer from "./components/Footer";
import Home from "./pages/Home";
import About from "./pages/About";
import ShaniDev from "./pages/ShaniDev";
import Darshan from "./pages/Darshan";
import Seva from "./pages/Seva";
import Donate from "./pages/Donate";
import Bhandara from "./pages/Bhandara";
import LiveAarti from "./pages/LiveAarti";
import Events from "./pages/Events";
import { Journal, ArticleDetail } from "./pages/Journal";
import Gallery from "./pages/Gallery";
import VisitUs from "./pages/VisitUs";
import Contact from "./pages/Contact";
import Testimonials from "./pages/Testimonials";
import Transparency from "./pages/Transparency";
import Admin from "./pages/Admin";

const Layout = ({ children }) => (
  <div className="min-h-screen flex flex-col bg-void text-ivory">
    <Navbar/>
    <main className="flex-1">{children}</main>
    <Footer/>
  </div>
);

function App() {
  return (
    <I18nProvider>
      <BrowserRouter>
        <Toaster theme="dark" position="top-center" richColors />
        <Routes>
          <Route path="/admin" element={<Admin/>} />
          <Route path="/" element={<Layout><Home/></Layout>} />
          <Route path="/about" element={<Layout><About/></Layout>} />
          <Route path="/shani-dev" element={<Layout><ShaniDev/></Layout>} />
          <Route path="/darshan" element={<Layout><Darshan/></Layout>} />
          <Route path="/seva" element={<Layout><Seva/></Layout>} />
          <Route path="/donate" element={<Layout><Donate/></Layout>} />
          <Route path="/bhandara" element={<Layout><Bhandara/></Layout>} />
          <Route path="/live-aarti" element={<Layout><LiveAarti/></Layout>} />
          <Route path="/events" element={<Layout><Events/></Layout>} />
          <Route path="/journal" element={<Layout><Journal/></Layout>} />
          <Route path="/journal/:slug" element={<Layout><ArticleDetail/></Layout>} />
          <Route path="/gallery" element={<Layout><Gallery/></Layout>} />
          <Route path="/visit-us" element={<Layout><VisitUs/></Layout>} />
          <Route path="/contact" element={<Layout><Contact/></Layout>} />
          <Route path="/experiences" element={<Layout><Testimonials/></Layout>} />
          <Route path="/transparency" element={<Layout><Transparency/></Layout>} />
        </Routes>
      </BrowserRouter>
    </I18nProvider>
  );
}

export default App;
