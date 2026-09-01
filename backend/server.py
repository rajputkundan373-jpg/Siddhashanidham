from fastapi import FastAPI, APIRouter, HTTPException, Header
from dotenv import load_dotenv
from starlette.middleware.cors import CORSMiddleware
from motor.motor_asyncio import AsyncIOMotorClient
import os, logging, uuid
from pathlib import Path
from pydantic import BaseModel, Field, ConfigDict
from typing import List, Optional
from datetime import datetime, timezone

ROOT_DIR = Path(__file__).parent
load_dotenv(ROOT_DIR / '.env')

mongo_url = os.environ['MONGO_URL']
client = AsyncIOMotorClient(mongo_url)
db = client[os.environ['DB_NAME']]

app = FastAPI(title="Siddh Sannidham API")
api_router = APIRouter(prefix="/api")

ADMIN_TOKEN = os.environ.get('ADMIN_TOKEN', 'siddh-shani-admin-2026')


def now_iso():
    return datetime.now(timezone.utc).isoformat()


def gen_id():
    return str(uuid.uuid4())


# ---------- MODELS ----------
class BaseDoc(BaseModel):
    model_config = ConfigDict(extra="ignore")
    id: str = Field(default_factory=gen_id)
    created_at: str = Field(default_factory=now_iso)


class Event(BaseDoc):
    title_en: str
    title_hi: str
    date: str
    time: str
    location: str
    category: str
    description_en: str
    description_hi: str
    image: Optional[str] = None


class AartiTiming(BaseDoc):
    name_en: str
    name_hi: str
    time: str
    order: int = 0


class Bhandara(BaseDoc):
    date: str
    time: str
    title_en: str
    title_hi: str
    devotees_expected: int
    sponsor_amount: int
    description_en: str
    description_hi: str
    status: str = "upcoming"
    image: Optional[str] = None


class SevaOption(BaseDoc):
    name_en: str
    name_hi: str
    description_en: str
    description_hi: str
    amount: int
    category: str


class Article(BaseDoc):
    slug: str
    title_en: str
    title_hi: str
    category: str
    excerpt_en: str
    excerpt_hi: str
    content_en: str
    content_hi: str
    author: str = "Siddh Sannidham"
    image: str
    read_time: int = 5


class GalleryItem(BaseDoc):
    title_en: str
    title_hi: str
    category: str
    image: str


class VideoItem(BaseDoc):
    title_en: str
    title_hi: str
    category: str
    youtube_id: str


class Testimonial(BaseDoc):
    name: str
    city: str
    experience_en: str
    experience_hi: str
    date: str
    verified: bool = False


class TodayInfo(BaseDoc):
    day_en: str = "Saturday"
    day_hi: str = "शनिवार"
    special_note_en: str = "Shani Dev Special Aarti Day"
    special_note_hi: str = "शनि देव विशेष आरती दिवस"
    aarti_en: str
    aarti_hi: str
    puja_en: str
    puja_hi: str
    bhandara_en: str
    bhandara_hi: str
    special_event_en: str
    special_event_hi: str


class Donation(BaseModel):
    id: str = Field(default_factory=gen_id)
    created_at: str = Field(default_factory=now_iso)
    name: str
    email: str
    mobile: str
    amount: int
    purpose: str
    anonymous: bool = False
    pan: Optional[str] = None
    message: Optional[str] = None
    status: str = "pending"


class ContactMessage(BaseModel):
    id: str = Field(default_factory=gen_id)
    created_at: str = Field(default_factory=now_iso)
    name: str
    email: str
    mobile: str
    message: str


class NewsletterSubscriber(BaseModel):
    id: str = Field(default_factory=gen_id)
    created_at: str = Field(default_factory=now_iso)
    email: str


def check_admin(token: Optional[str]):
    if token != ADMIN_TOKEN:
        raise HTTPException(status_code=401, detail="Invalid admin token")


# ---------- ENDPOINTS ----------
@api_router.get("/")
async def root():
    return {"message": "Siddh Sannidham — Shani Dev Temple API", "status": "ok"}


@api_router.get("/temple-info")
async def temple_info():
    return {
        "name_en": "Siddh Sannidham",
        "name_hi": "सिद्ध सन्निधम्",
        "subtitle_en": "Shani Dev Temple",
        "subtitle_hi": "शनि देव तीर्थ",
        "address": "Etawa–Gwalior Road, Madhya Pradesh, India",
        "phone": "+91 98XXX XXXXX",
        "whatsapp": "+919999999999",
        "email": "seva@siddhsannidham.org",
        "maps_url": "https://maps.google.com/?q=Etawa+Gwalior+Road+Madhya+Pradesh",
        "socials": {
            "youtube": "https://youtube.com/@siddhsannidham",
            "instagram": "https://instagram.com/siddhsannidham",
            "facebook": "https://facebook.com/siddhsannidham",
            "whatsapp": "https://wa.me/919999999999"
        },
        "upi_id": "siddhsannidham@upi",
        "bank": {
            "name": "State Bank of India",
            "account": "XXXXXXXXXXXX",
            "ifsc": "SBIN0XXXXXX",
            "holder": "Siddh Sannidham Trust"
        }
    }


# Events
@api_router.get("/events", response_model=List[Event])
async def list_events():
    docs = await db.events.find({}, {"_id": 0}).sort("date", 1).to_list(200)
    return docs


@api_router.post("/events", response_model=Event)
async def create_event(event: Event, x_admin_token: Optional[str] = Header(None)):
    check_admin(x_admin_token)
    await db.events.insert_one(event.model_dump())
    return event


# Aarti timings
@api_router.get("/aarti-timings", response_model=List[AartiTiming])
async def list_aartis():
    docs = await db.aarti_timings.find({}, {"_id": 0}).sort("order", 1).to_list(50)
    return docs


# Bhandaras
@api_router.get("/bhandaras", response_model=List[Bhandara])
async def list_bhandaras():
    docs = await db.bhandaras.find({}, {"_id": 0}).sort("date", 1).to_list(100)
    return docs


@api_router.post("/bhandaras", response_model=Bhandara)
async def create_bhandara(b: Bhandara, x_admin_token: Optional[str] = Header(None)):
    check_admin(x_admin_token)
    await db.bhandaras.insert_one(b.model_dump())
    return b


# Seva
@api_router.get("/seva", response_model=List[SevaOption])
async def list_seva():
    return await db.seva.find({}, {"_id": 0}).to_list(100)


# Articles
@api_router.get("/articles", response_model=List[Article])
async def list_articles():
    return await db.articles.find({}, {"_id": 0}).sort("created_at", -1).to_list(100)


@api_router.get("/articles/{slug}", response_model=Article)
async def get_article(slug: str):
    doc = await db.articles.find_one({"slug": slug}, {"_id": 0})
    if not doc:
        raise HTTPException(status_code=404, detail="Article not found")
    return doc


@api_router.post("/articles", response_model=Article)
async def create_article(a: Article, x_admin_token: Optional[str] = Header(None)):
    check_admin(x_admin_token)
    await db.articles.insert_one(a.model_dump())
    return a


# Gallery
@api_router.get("/gallery", response_model=List[GalleryItem])
async def list_gallery():
    return await db.gallery.find({}, {"_id": 0}).to_list(200)


# Videos
@api_router.get("/videos", response_model=List[VideoItem])
async def list_videos():
    return await db.videos.find({}, {"_id": 0}).to_list(100)


# Testimonials
@api_router.get("/testimonials", response_model=List[Testimonial])
async def list_testimonials():
    return await db.testimonials.find({}, {"_id": 0}).sort("created_at", -1).to_list(100)


@api_router.post("/testimonials", response_model=Testimonial)
async def add_testimonial(t: Testimonial):
    await db.testimonials.insert_one(t.model_dump())
    return t


# Today
@api_router.get("/today")
async def get_today():
    doc = await db.today_info.find_one({}, {"_id": 0}, sort=[("created_at", -1)])
    if not doc:
        return {}
    return doc


# Donations
@api_router.post("/donations", response_model=Donation)
async def create_donation(d: Donation):
    await db.donations.insert_one(d.model_dump())
    return d


@api_router.get("/donations/recent")
async def recent_donations():
    docs = await db.donations.find({"anonymous": False}, {"_id": 0, "email": 0, "mobile": 0, "pan": 0}).sort("created_at", -1).limit(10).to_list(10)
    return docs


# Contact
@api_router.post("/contact", response_model=ContactMessage)
async def create_contact(c: ContactMessage):
    await db.contact_messages.insert_one(c.model_dump())
    return c


# Newsletter
@api_router.post("/newsletter", response_model=NewsletterSubscriber)
async def subscribe(n: NewsletterSubscriber):
    existing = await db.newsletter.find_one({"email": n.email})
    if existing:
        return NewsletterSubscriber(**{k: v for k, v in existing.items() if k != "_id"})
    await db.newsletter.insert_one(n.model_dump())
    return n


# Admin - list all donations, contacts
@api_router.get("/admin/donations")
async def admin_donations(x_admin_token: Optional[str] = Header(None)):
    check_admin(x_admin_token)
    return await db.donations.find({}, {"_id": 0}).sort("created_at", -1).to_list(500)


@api_router.get("/admin/contacts")
async def admin_contacts(x_admin_token: Optional[str] = Header(None)):
    check_admin(x_admin_token)
    return await db.contact_messages.find({}, {"_id": 0}).sort("created_at", -1).to_list(500)


@api_router.post("/admin/today")
async def update_today(info: TodayInfo, x_admin_token: Optional[str] = Header(None)):
    check_admin(x_admin_token)
    await db.today_info.delete_many({})
    await db.today_info.insert_one(info.model_dump())
    return info


# ---------- SEED ----------
async def seed():
    if await db.aarti_timings.count_documents({}) == 0:
        await db.aarti_timings.insert_many([
            AartiTiming(name_en="Mangala Aarti", name_hi="मंगला आरती", time="05:30 AM", order=1).model_dump(),
            AartiTiming(name_en="Bhog Aarti", name_hi="भोग आरती", time="12:00 PM", order=2).model_dump(),
            AartiTiming(name_en="Sandhya Aarti", name_hi="संध्या आरती", time="07:15 PM", order=3).model_dump(),
            AartiTiming(name_en="Shayan Aarti", name_hi="शयन आरती", time="09:30 PM", order=4).model_dump(),
        ])

    if await db.seva.count_documents({}) == 0:
        await db.seva.insert_many([
            SevaOption(name_en="Anna Seva", name_hi="अन्न सेवा", description_en="Sponsor meals for devotees visiting the temple.", description_hi="मंदिर आने वाले भक्तों के लिए भोजन प्रायोजित करें।", amount=1101, category="Food").model_dump(),
            SevaOption(name_en="Bhandara Seva", name_hi="भंडारा सेवा", description_en="Sponsor a community bhandara on special days.", description_hi="विशेष दिनों पर सामुदायिक भंडारा का आयोजन करें।", amount=11001, category="Community").model_dump(),
            SevaOption(name_en="Temple Seva", name_hi="मंदिर सेवा", description_en="Contribute to temple maintenance and adornment.", description_hi="मंदिर के रखरखाव एवं श्रृंगार में योगदान दें।", amount=2501, category="Temple").model_dump(),
            SevaOption(name_en="Pujan Seva", name_hi="पूजन सेवा", description_en="Sponsor a special puja performed in your name.", description_hi="आपके नाम पर विशेष पूजा प्रायोजित करें।", amount=1501, category="Puja").model_dump(),
            SevaOption(name_en="Gau Seva", name_hi="गौ सेवा", description_en="Support the care of sacred cows at our goshala.", description_hi="हमारी गौशाला में गायों की सेवा में सहयोग करें।", amount=501, category="Community").model_dump(),
            SevaOption(name_en="Needy Seva", name_hi="जरूरतमंद सेवा", description_en="Support underprivileged families with essentials.", description_hi="जरूरतमंद परिवारों को आवश्यक सामग्री उपलब्ध कराएं।", amount=2101, category="Community").model_dump(),
        ])

    if await db.events.count_documents({}) == 0:
        await db.events.insert_many([
            Event(title_en="Shani Amavasya Maha Puja", title_hi="शनि अमावस्या महा पूजा", date="2026-03-19", time="04:30 AM – 09:30 PM", location="Main Sanctum", category="Special Puja", description_en="Auspicious Shani Amavasya rituals with special abhishekam.", description_hi="विशेष अभिषेक के साथ शुभ शनि अमावस्या अनुष्ठान।", image="https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1200&q=85").model_dump(),
            Event(title_en="Saturday Special Aarti", title_hi="शनिवार विशेष आरती", date="2026-02-28", time="07:15 PM", location="Main Sanctum", category="Saturday", description_en="Every Saturday, join the special sandhya aarti of Shani Dev.", description_hi="प्रत्येक शनिवार, शनि देव की विशेष संध्या आरती में सम्मिलित हों।", image="https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1200&q=85").model_dump(),
            Event(title_en="Shani Jayanti Mahotsav", title_hi="शनि जयंती महोत्सव", date="2026-05-26", time="Full Day", location="Temple Complex", category="Festival", description_en="Grand celebration of Shani Dev's appearance day with day-long rituals and bhandara.", description_hi="शनि देव के प्राकट्य दिवस का भव्य उत्सव, दिनभर अनुष्ठान एवं भंडारा।", image="https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1200&q=85").model_dump(),
        ])

    if await db.bhandaras.count_documents({}) == 0:
        await db.bhandaras.insert_many([
            Bhandara(date="2026-02-28", time="12:30 PM", title_en="Saturday Bhandara", title_hi="शनिवार भंडारा", devotees_expected=500, sponsor_amount=11001, description_en="Sattvic meal for all devotees.", description_hi="सभी भक्तों के लिए सात्विक प्रसाद।", image="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1200&q=85").model_dump(),
            Bhandara(date="2026-03-19", time="01:00 PM", title_en="Amavasya Maha Bhandara", title_hi="अमावस्या महा भंडारा", devotees_expected=2000, sponsor_amount=51001, description_en="Grand Amavasya bhandara open to all.", description_hi="सभी के लिए विशाल अमावस्या भंडारा।", image="https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1200&q=85").model_dump(),
        ])

    if await db.articles.count_documents({}) == 0:
        base_img = "https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1600&q=85"
        await db.articles.insert_many([
            Article(slug="who-is-shani-dev", title_en="Who is Shani Dev?", title_hi="कौन हैं शनि देव?",
                    category="Shani Dev", excerpt_en="Understanding the deity of karma, justice and discipline.",
                    excerpt_hi="कर्म, न्याय और अनुशासन के देवता का परिचय।",
                    content_en="Shani Dev, son of Surya and Chhaya, is revered in the Hindu tradition as the lord of karma. He is neither cruel nor punishing by nature — he is a just observer of every soul's actions. Devotees who walk the path of dharma, honesty and service find his gaze to be a source of clarity, strength and blessings.",
                    content_hi="शनि देव, सूर्य एवं छाया के पुत्र, हिन्दू परंपरा में कर्म के देवता के रूप में पूजित हैं। वे किसी को दंडित करने वाले नहीं हैं — वे प्रत्येक आत्मा के कर्मों के न्यायकारी दृष्टा हैं। जो भक्त धर्म, सच्चाई और सेवा के मार्ग पर चलते हैं, उनके लिए शनि देव की दृष्टि स्पष्टता, शक्ति और आशीर्वाद का स्रोत बनती है।",
                    image=base_img, read_time=6).model_dump(),
            Article(slug="shani-mantra-jaap-vidhi", title_en="Shani Mantra & Jaap Vidhi", title_hi="शनि मंत्र एवं जाप विधि",
                    category="Mantra", excerpt_en="The traditional method of chanting Shani mantras.",
                    excerpt_hi="शनि मंत्रों के जाप की पारंपरिक विधि।",
                    content_en="The Shani Beej Mantra 'Om Praam Preem Praum Sah Shanaischaraya Namah' is traditionally recited 108 times on Saturdays. Sit facing west, light a mustard-oil diya, and chant with steady breath and a sattvic heart.",
                    content_hi="शनि बीज मंत्र 'ॐ प्रां प्रीं प्रौं सः शनैश्चराय नमः' का पारंपरिक रूप से शनिवार को 108 बार जाप किया जाता है। पश्चिम की ओर मुख करके बैठें, सरसों के तेल का दीपक जलाएं, और स्थिर श्वास एवं सात्विक हृदय से जाप करें।",
                    image=base_img, read_time=5).model_dump(),
            Article(slug="saturday-worship-vidhi", title_en="Saturday Worship — Shanivar Vidhi", title_hi="शनिवार पूजन विधि",
                    category="Puja Vidhi", excerpt_en="How to perform Shani worship at home on Saturdays.",
                    excerpt_hi="घर पर शनिवार को शनि पूजन कैसे करें।",
                    content_en="Bathe early, wear clean clothes (ideally black or dark blue), offer mustard oil, black sesame seeds and blue flowers to Shani Dev. Read the Shani Chalisa and offer prayers with humility.",
                    content_hi="प्रातः स्नान कर स्वच्छ (काले अथवा गहरे नीले) वस्त्र धारण करें, शनि देव को सरसों का तेल, काले तिल एवं नील पुष्प अर्पित करें। शनि चालीसा का पाठ करें और विनम्रता से प्रार्थना करें।",
                    image=base_img, read_time=4).model_dump(),
            Article(slug="karma-and-shani", title_en="Karma and Shani Dev", title_hi="कर्म और शनि देव",
                    category="Philosophy", excerpt_en="Why Shani is called Karma Phaldata.",
                    excerpt_hi="शनि देव को कर्म फलदाता क्यों कहा जाता है।",
                    content_en="Shani Dev is called Karma Phaldata — the giver of the fruits of action. His teaching is simple: what we sow with intent, we reap with grace. Living with truth, service and patience aligns us with his blessings.",
                    content_hi="शनि देव को 'कर्म फलदाता' कहा जाता है — कर्मों का फल देने वाले। उनकी शिक्षा सरल है: जो हम भाव से बोते हैं, वही कृपा से पाते हैं। सत्य, सेवा एवं धैर्य से जीवन जीना उनकी कृपा से जोड़ता है।",
                    image=base_img, read_time=5).model_dump(),
        ])

    if await db.gallery.count_documents({}) == 0:
        imgs = [
            ("https://images.unsplash.com/photo-1665003725647-3ae0f01140b1?w=1200&q=85", "Temple", "मंदिर", "Temple"),
            ("https://images.unsplash.com/photo-1629735919597-fed920b5bd84?w=1200&q=85", "Sanctum Geometry", "गर्भगृह ज्यामिति", "Temple"),
            ("https://images.unsplash.com/photo-1672215060701-c4207cbdc430?w=1200&q=85", "Shikhara Carvings", "शिखर पर नक्काशी", "Temple"),
            ("https://images.unsplash.com/photo-1619239632374-9e6651c2b7bb?w=1200&q=85", "Temple Gopuram", "मंदिर गोपुरम", "Temple"),
            ("https://images.unsplash.com/photo-1775427528127-a66ce3bb2bcb?w=1200&q=85", "Aarti Flames", "आरती की ज्योति", "Aarti"),
            ("https://images.unsplash.com/photo-1701093919822-899072e02c41?w=1200&q=85", "Sacred Diya", "पवित्र दीप", "Aarti"),
            ("https://images.unsplash.com/photo-1596704017254-9b121068fb31?w=1200&q=85", "Marigold Offerings", "गेंदा पुष्प", "Seva"),
        ]
        await db.gallery.insert_many([
            GalleryItem(image=u, title_en=t_en, title_hi=t_hi, category=cat).model_dump()
            for (u, t_en, t_hi, cat) in imgs
        ])

    if await db.videos.count_documents({}) == 0:
        await db.videos.insert_many([
            VideoItem(title_en="Live Aarti at Siddh Sannidham", title_hi="सिद्ध सन्निधम् में लाइव आरती", category="Live Aarti", youtube_id="jfKfPfyJRdk").model_dump(),
            VideoItem(title_en="Shani Chalisa Path", title_hi="शनि चालीसा पाठ", category="Devotional", youtube_id="ZbZSe6N_BXs").model_dump(),
            VideoItem(title_en="Bhandara at Siddh Sannidham", title_hi="सिद्ध सन्निधम् में भंडारा", category="Bhandara", youtube_id="5qap5aO4i9A").model_dump(),
        ])

    if await db.testimonials.count_documents({}) == 0:
        await db.testimonials.insert_many([
            Testimonial(name="Ramesh Sharma", city="Gwalior", experience_en="Visiting Siddh Sannidham gave my family a rare sense of peace and clarity.", experience_hi="सिद्ध सन्निधम् की यात्रा ने मेरे परिवार को दुर्लभ शांति एवं स्पष्टता दी।", date="2026-01-14", verified=True).model_dump(),
            Testimonial(name="Anjali Verma", city="Etawah", experience_en="The Saturday aarti here is deeply moving — the discipline and devotion is remarkable.", experience_hi="यहाँ की शनिवार आरती अत्यंत भावपूर्ण है — अनुशासन एवं भक्ति उल्लेखनीय है।", date="2026-01-22", verified=True).model_dump(),
            Testimonial(name="Suresh Yadav", city="Agra", experience_en="I sponsored a bhandara here and the way it was organised reflected true seva bhav.", experience_hi="मैंने यहाँ भंडारा प्रायोजित किया और जिस तरह उसका आयोजन हुआ, वह सच्चा सेवा भाव दर्शाता है।", date="2026-02-05", verified=False).model_dump(),
        ])

    if await db.today_info.count_documents({}) == 0:
        await db.today_info.insert_one(TodayInfo(
            day_en="Saturday", day_hi="शनिवार",
            special_note_en="Shani Dev Special Aarti Day",
            special_note_hi="शनि देव विशेष आरती दिवस",
            aarti_en="Sandhya Aarti at 07:15 PM",
            aarti_hi="संध्या आरती सायं 07:15 बजे",
            puja_en="Shani Tel Abhishek at 06:00 PM",
            puja_hi="शनि तेल अभिषेक सायं 06:00 बजे",
            bhandara_en="Sattvic Bhandara at 12:30 PM",
            bhandara_hi="सात्विक भंडारा दोपहर 12:30 बजे",
            special_event_en="Blessing Ceremony after evening aarti",
            special_event_hi="संध्या आरती के पश्चात आशीर्वाद समारोह"
        ).model_dump())


app.include_router(api_router)

app.add_middleware(
    CORSMiddleware,
    allow_credentials=True,
    allow_origins=os.environ.get('CORS_ORIGINS', '*').split(','),
    allow_methods=["*"],
    allow_headers=["*"],
)

logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(name)s - %(levelname)s - %(message)s')
logger = logging.getLogger(__name__)


@app.on_event("startup")
async def on_start():
    await seed()
    logger.info("Siddh Sannidham API started, data seeded.")


@app.on_event("shutdown")
async def shutdown_db_client():
    client.close()
