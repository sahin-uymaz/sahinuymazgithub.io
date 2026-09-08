<?php
require_once 'config.php';
$news = loadNews();

// Kategorilere göre grupla
$byCategory = [];
foreach ($news as $n) {
    $cat = $n['category'];
    if (!isset($byCategory[$cat])) $byCategory[$cat] = [];
    $byCategory[$cat][] = $n;
}

// Slider için featured veya en yeni 3
$featured = array_filter($news, fn($n) => !empty($n['featured']));
$featured = array_values($featured);
if (count($featured) < 1) {
    $featured = array_slice($news, 0, 3);
}
$featured = array_slice($featured, 0, 3);

// Son dakika için en yeni 4
$breaking = array_slice($news, 0, 4);

// En çok okunan (şimdilik en yeni 5)
$mostRead = array_slice($news, 0, 5);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ŞAHİN UYMAZ | Haber • Gündem • Yorum • Analiz</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{
    --lacivert:#081b33;--mavi:#123f73;--kirmizi:#d71920;--turuncu:#f59e0b;
    --acik:#f4f6f9;--gri:#667085;--border:#e4e7ec;--white:#fff;--text:#111827;
}
body{font-family:Inter,Arial,sans-serif;background:var(--acik);color:var(--text)}
a{text-decoration:none;color:inherit}
button{font-family:inherit}
.topbar{background:#061426;color:#cbd5e1;font-size:12px;padding:8px 0}
.topbar-inner{width:94%;max-width:1400px;margin:auto;display:flex;justify-content:space-between}
.header{background:#fff;border-bottom:1px solid var(--border)}
.header-inner{width:94%;max-width:1400px;min-height:88px;margin:auto;display:flex;align-items:center;justify-content:space-between}
.logo{display:flex;align-items:center;gap:13px}
.logo-image{width:52px;height:52px;border-radius:8px;object-fit:contain;background:#fff}
.logo-text strong{display:block;font-size:22px;letter-spacing:-.5px}
.logo-text span{display:block;font-size:10px;color:#667085;letter-spacing:1.5px;margin-top:4px}
.nav{display:flex;align-items:center;gap:22px;font-size:13px;font-weight:700}
.nav a{transition:.2s}
.nav a:hover{color:var(--kirmizi)}
.search{width:38px;height:38px;border:1px solid var(--border);border-radius:50%;background:#fff;cursor:pointer}
.breaking{background:#fff;border-bottom:1px solid var(--border)}
.breaking-inner{width:94%;max-width:1400px;height:46px;margin:auto;display:flex;align-items:center;overflow:hidden}
.breaking-label{background:var(--kirmizi);color:white;padding:8px 14px;font-size:11px;font-weight:900;white-space:nowrap;animation:pulse 1.7s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.72}}
.breaking-text{margin-left:15px;font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden}
.container{width:94%;max-width:1400px;margin:28px auto 70px}
.section-title{display:flex;justify-content:space-between;align-items:center;border-bottom:2px solid var(--lacivert);padding-bottom:10px;margin:38px 0 18px}
.section-title h2{font-family:"Playfair Display",serif;font-size:25px}
.section-title a{font-size:11px;font-weight:800;color:var(--mavi)}
.gundem-slider{position:relative;min-height:460px;overflow:hidden;border-radius:9px;background:#091d35}
.slide{position:absolute;inset:0;opacity:0;visibility:hidden;transition:opacity .7s ease;display:grid;grid-template-columns:1.7fr 1fr}
.slide.active{opacity:1;visibility:visible}
.slide-image{background-size:cover;background-position:center;background-color:#0d213a}
.slide-content{color:white;padding:48px 42px;display:flex;flex-direction:column;justify-content:center}
.slide-category{display:inline-block;width:max-content;background:var(--kirmizi);padding:7px 11px;font-size:10px;font-weight:900;letter-spacing:.7px;margin-bottom:15px}
.slide-content h1{font-family:"Playfair Display",serif;font-size:39px;line-height:1.08;margin-bottom:15px}
.slide-content p{color:#d9e3ee;font-size:14px;line-height:1.7}
.read-more{width:max-content;margin-top:22px;padding:10px 16px;background:#fff;color:var(--lacivert);border-radius:4px;font-size:11px;font-weight:900}
.slider-controls{position:absolute;bottom:22px;left:22px;display:flex;gap:7px;z-index:5}
.slider-dot{width:9px;height:9px;border:0;border-radius:50%;background:rgba(255,255,255,.45);cursor:pointer}
.slider-dot.active{background:#fff;transform:scale(1.2)}
.news-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px}
.news-card{background:#fff;border:1px solid var(--border);border-radius:7px;overflow:hidden;transition:.25s}
.news-card:hover{transform:translateY(-3px);box-shadow:0 10px 28px rgba(0,0,0,.08)}
.news-image{height:165px;background-size:cover;background-position:center;background-color:#234d78}
.news-content{padding:17px}
.mini-cat{color:var(--kirmizi);font-size:10px;font-weight:900;letter-spacing:.5px;margin-bottom:8px}
.news-content h3{font-family:"Playfair Display",serif;font-size:18px;line-height:1.25;margin-bottom:8px}
.news-content p{color:var(--gri);font-size:12px;line-height:1.55}
.commentary{background:var(--lacivert);color:#fff;border-radius:8px;padding:35px;display:grid;grid-template-columns:1fr 2fr;gap:35px}
.commentary-label{color:#9db9d7;font-size:10px;font-weight:900;letter-spacing:1.5px}
.commentary h2{font-family:"Playfair Display",serif;font-size:34px;margin-top:8px}
.commentary-text{border-left:1px solid rgba(255,255,255,.2);padding-left:35px}
.commentary-text h3{font-family:"Playfair Display",serif;font-size:25px;margin-bottom:10px}
.commentary-text p{color:#d9e4ef;font-size:14px;line-height:1.7}
.sports-box{background:#fff;border:1px solid var(--border);border-radius:8px;padding:24px}
.sports-layout{display:grid;grid-template-columns:2fr 1fr;gap:24px}
.sports-news{padding-right:24px;border-right:1px solid var(--border)}
.sports-news h3{font-family:"Playfair Display",serif;font-size:27px;margin:8px 0}
.sports-news p{color:var(--gri);font-size:13px;line-height:1.6}
.prediction{background:#f8f9fb;border:1px solid var(--border);border-radius:7px;padding:22px}
.prediction-label{color:var(--kirmizi);font-size:10px;font-weight:900;letter-spacing:1px}
.prediction h3{font-family:"Playfair Display",serif;font-size:21px;margin:8px 0}
.prediction p{color:var(--gri);font-size:12px;line-height:1.5}
.prediction button{width:100%;margin-top:15px;padding:11px;background:var(--lacivert);color:white;border:0;border-radius:4px;font-size:11px;font-weight:900;cursor:pointer}
.prediction-result{display:none;margin-top:12px;padding:12px;background:#fff;border:1px solid var(--border);text-align:center;font-weight:900}
.two-columns{display:grid;grid-template-columns:2fr 1fr;gap:24px}
.topic{background:#fff;border:1px solid var(--border);border-radius:8px;padding:25px}
.topic-label{color:var(--kirmizi);font-size:10px;font-weight:900;letter-spacing:1px}
.topic h3{font-family:"Playfair Display",serif;font-size:28px;line-height:1.2;margin:10px 0}
.topic p{color:var(--gri);font-size:14px;line-height:1.7}
.most-read{background:#fff;border:1px solid var(--border);border-radius:8px;padding:22px}
.read-item{display:flex;gap:13px;padding:13px 0;border-bottom:1px solid var(--border)}
.read-item:last-child{border-bottom:0}
.read-number{font-size:24px;font-weight:900;color:#d0d5dd}
.read-item h3{font-size:13px;line-height:1.4}
.poll{background:#fff;border:1px solid var(--border);border-radius:8px;padding:26px}
.poll h3{font-family:"Playfair Display",serif;font-size:25px;margin-bottom:8px}
.poll p{color:var(--gri);font-size:13px;margin-bottom:18px}
.poll-option{display:block;border:1px solid var(--border);padding:12px;border-radius:5px;margin-bottom:8px;font-size:13px;cursor:pointer}
.poll-option:hover{border-color:var(--mavi)}
.update{display:flex;justify-content:flex-end;align-items:center;gap:7px;color:#667085;font-size:11px;margin-top:20px}
.update-dot{width:7px;height:7px;border-radius:50%;background:#12b76a}
footer{background:#061426;color:#fff;padding:42px 0}
.footer-inner{width:94%;max-width:1400px;margin:auto;display:flex;justify-content:space-between}
.footer-brand strong{font-size:20px}
.footer-brand p{margin-top:7px;color:#9eb0c5;font-size:11px}
.footer-links{display:flex;gap:20px;color:#cbd5e1;font-size:12px}
.empty-note{background:#fff;border:1px dashed var(--border);border-radius:8px;padding:40px;text-align:center;color:var(--gri);font-size:14px}
@media(max-width:1100px){.nav{gap:12px;font-size:11px}.news-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:750px){
    .topbar-inner{justify-content:center}.topbar-inner span:last-child{display:none}
    .header-inner{min-height:72px}.logo-image{width:43px;height:43px}.logo-text strong{font-size:18px}.logo-text span{font-size:8px}.nav{display:none}
    .gundem-slider{min-height:510px}.slide{grid-template-columns:1fr}.slide-image{min-height:180px}
    .slide-content{padding:25px}.slide-content h1{font-size:29px}.news-grid{grid-template-columns:1fr}
    .commentary{grid-template-columns:1fr;gap:20px}.commentary-text{border-left:0;border-top:1px solid rgba(255,255,255,.2);padding-left:0;padding-top:20px}
    .sports-layout{grid-template-columns:1fr}.sports-news{border-right:0;border-bottom:1px solid var(--border);padding-right:0;padding-bottom:20px}
    .two-columns{grid-template-columns:1fr}.footer-inner{flex-direction:column;gap:25px}.footer-links{flex-wrap:wrap}
}
</style>
</head>
<body>
<!-- ÜST BİLGİ -->
<div class="topbar">
    <div class="topbar-inner">
        <span>ŞAHİN UYMAZ | Haber • Gündem • Yorum • Analiz</span>
        <span id="date"></span>
    </div>
</div>
<!-- HEADER -->
<header class="header">
    <div class="header-inner">
        <a href="index.php" class="logo">
            <img src="logo.png" class="logo-image" alt="Şahin UYMAZ" onerror="this.style.display='none'">
            <div class="logo-text">
                <strong>ŞAHİN UYMAZ</strong>
                <span>HABER • GÜNDEM • YORUM • ANALİZ</span>
            </div>
        </a>
        <nav class="nav">
            <a href="#siyaset">Siyaset</a>
            <a href="#ekonomi">Ekonomi</a>
            <a href="#saglik">Sağlık</a>
            <a href="#spor">Spor</a>
            <a href="#dunya">Dünya</a>
            <a href="#toplum">Toplum</a>
            <a href="#yorum">Yorum</a>
            <button class="search">⌕</button>
        </nav>
    </div>
</header>
<!-- SON DAKİKA -->
<div class="breaking">
    <div class="breaking-inner">
        <div class="breaking-label">🔴 SON DAKİKA</div>
        <div class="breaking-text" id="breakingText">
            <?= !empty($breaking) ? htmlspecialchars($breaking[0]['title']) : 'Henüz haber eklenmedi. Admin panelinden ekleyin.' ?>
        </div>
    </div>
</div>

<main class="container">
<!-- GÜNDEM SLIDER -->
<div class="section-title">
    <h2>Gündem</h2>
    <a href="#gundem">TÜM GÜNDEM HABERLERİ →</a>
</div>

<?php if (empty($featured)): ?>
<section class="empty-note">
    Henüz haber yok. <a href="admin.php" style="color:var(--mavi);font-weight:700">Admin paneline</a> girip haber ekleyin.
</section>
<?php else: ?>
<section class="gundem-slider">
    <?php foreach ($featured as $i => $item): ?>
    <article class="slide <?= $i===0 ? 'active' : '' ?>">
        <div class="slide-image" style="<?= !empty($item['image']) ? 'background-image:url('.htmlspecialchars($item['image']).')' : '' ?>"></div>
        <div class="slide-content">
            <span class="slide-category"><?= htmlspecialchars($item['category']) ?></span>
            <h1><?= htmlspecialchars($item['title']) ?></h1>
            <p><?= htmlspecialchars($item['summary'] ?: mb_substr(strip_tags($item['content']), 0, 120).'...') ?></p>
            <a href="haber.php?id=<?= urlencode($item['id']) ?>" class="read-more">HABERİ OKU →</a>
        </div>
    </article>
    <?php endforeach; ?>
    <div class="slider-controls">
        <?php for ($i=0; $i<count($featured); $i++): ?>
        <button class="slider-dot <?= $i===0?'active':'' ?>" onclick="goSlide(<?= $i ?>)"></button>
        <?php endfor; ?>
    </div>
</section>
<?php endif; ?>

<?php
// Kategori bölümleri
$sections = [
    'Siyaset' => ['id'=>'siyaset', 'icon'=>'🏛️'],
    'Ekonomi' => ['id'=>'ekonomi', 'icon'=>'💰'],
    'Sağlık'  => ['id'=>'saglik',  'icon'=>'🏥'],
    'Spor'    => ['id'=>'spor',    'icon'=>'⚽'],
    'Dünya'   => ['id'=>'dunya',   'icon'=>'🌍'],
    'Toplum'  => ['id'=>'toplum',  'icon'=>'👥'],
];

foreach ($sections as $catName => $meta):
    $items = $byCategory[$catName] ?? [];
    if ($catName === 'Spor') {
        // Spor özel layout
?>
<div class="section-title" id="spor">
    <h2>⚽ Spor</h2>
    <a href="#">TÜM SPOR HABERLERİ →</a>
</div>
<section class="sports-box">
    <div class="sports-layout">
        <article class="sports-news">
            <?php if (!empty($items)): $first = $items[0]; ?>
            <div class="mini-cat">SPOR GÜNDEMİ</div>
            <h3><?= htmlspecialchars($first['title']) ?></h3>
            <p><?= htmlspecialchars($first['summary'] ?: mb_substr(strip_tags($first['content']),0,180).'...') ?></p>
            <a href="haber.php?id=<?= urlencode($first['id']) ?>" style="display:inline-block;margin-top:12px;font-size:12px;font-weight:700;color:var(--mavi)">Devamını oku →</a>
            <?php else: ?>
            <div class="mini-cat">SPOR GÜNDEMİ</div>
            <h3>Sporda günün öne çıkan gelişmeleri</h3>
            <p>Henüz spor haberi eklenmedi.</p>
            <?php endif; ?>
        </article>
        <aside class="prediction">
            <div class="prediction-label">🔮 ŞAHİN UYMAZ MAÇ TAHMİNİ</div>
            <h3>Maç öncesi özel değerlendirme</h3>
            <p>Şahin UYMAZ'ın maç öncesi değerlendirmesini görmek için tahmini açın.</p>
            <button onclick="showPrediction()">TAHMİNİ GÖR</button>
            <div class="prediction-result" id="predictionResult">Ev sahibi 2 – 1 kazanır.</div>
        </aside>
    </div>
</section>
<?php
        continue;
    }
?>
<div class="section-title" id="<?= $meta['id'] ?>">
    <h2><?= $meta['icon'] ?> <?= $catName ?></h2>
    <a href="#">TÜM HABERLER →</a>
</div>
<section class="news-grid">
    <?php if (empty($items)): ?>
        <div class="empty-note" style="grid-column:1/-1">Bu kategoride henüz haber yok.</div>
    <?php else:
        foreach (array_slice($items, 0, 4) as $item): ?>
    <article class="news-card">
        <div class="news-image" style="<?= !empty($item['image']) ? 'background-image:url('.htmlspecialchars($item['image']).')' : '' ?>"></div>
        <div class="news-content">
            <div class="mini-cat"><?= htmlspecialchars($item['category']) ?></div>
            <h3><a href="haber.php?id=<?= urlencode($item['id']) ?>"><?= htmlspecialchars($item['title']) ?></a></h3>
            <p><?= htmlspecialchars($item['summary'] ?: mb_substr(strip_tags($item['content']),0,90).'...') ?></p>
        </div>
    </article>
    <?php endforeach; endif; ?>
</section>
<?php endforeach; ?>

<!-- YORUM -->
<?php
$yorumItems = $byCategory['Yorum'] ?? [];
$yorum = !empty($yorumItems) ? $yorumItems[0] : null;
?>
<div class="section-title" id="yorum">
    <h2>✍️ Şahin UYMAZ Yorumluyor</h2>
</div>
<section class="commentary">
    <div>
        <div class="commentary-label">GÜNÜN YORUMU</div>
        <h2>Şahin UYMAZ</h2>
    </div>
    <div class="commentary-text">
        <?php if ($yorum): ?>
        <h3><?= htmlspecialchars($yorum['title']) ?></h3>
        <p><?= htmlspecialchars($yorum['summary'] ?: mb_substr(strip_tags($yorum['content']),0,250).'...') ?></p>
        <a href="haber.php?id=<?= urlencode($yorum['id']) ?>" style="display:inline-block;margin-top:14px;color:#9db9d7;font-size:12px;font-weight:700">Yorumun tamamını oku →</a>
        <?php else: ?>
        <h3>Gündemin arka planında ne var?</h3>
        <p>Güncel gelişmeleri yalnızca aktarmak değil; olayların nedenlerini, sonuçlarını ve vatandaş üzerindeki etkilerini değerlendirmek.</p>
        <?php endif; ?>
    </div>
</section>

<!-- GÜNÜN KONUSU + EN ÇOK OKUNAN -->
<div class="two-columns">
    <div>
        <div class="section-title"><h2>📊 Günün Konusu</h2></div>
        <article class="topic">
            <?php if (!empty($news)): $top = $news[0]; ?>
            <div class="topic-label">BUGÜNÜN ANA GÜNDEMİ</div>
            <h3><?= htmlspecialchars($top['title']) ?></h3>
            <p><?= htmlspecialchars($top['summary'] ?: mb_substr(strip_tags($top['content']),0,200).'...') ?></p>
            <a href="haber.php?id=<?= urlencode($top['id']) ?>" style="display:inline-block;margin-top:12px;font-size:12px;font-weight:700;color:var(--mavi)">Detayları gör →</a>
            <?php else: ?>
            <div class="topic-label">BUGÜNÜN ANA GÜNDEMİ</div>
            <h3>Türkiye bugün en çok neyi konuşuyor?</h3>
            <p>Henüz haber eklenmedi. Admin panelinden ekleyin.</p>
            <?php endif; ?>
        </article>
    </div>
    <div>
        <div class="section-title"><h2>🔥 Günün En Çok Okunanları</h2></div>
        <div class="most-read">
            <?php if (empty($mostRead)): ?>
                <p style="color:var(--gri);font-size:13px">Henüz haber yok.</p>
            <?php else:
                foreach ($mostRead as $i => $item): ?>
            <div class="read-item">
                <div class="read-number"><?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?></div>
                <h3><a href="haber.php?id=<?= urlencode($item['id']) ?>"><?= htmlspecialchars($item['title']) ?></a></h3>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>

<!-- ANKET -->
<div class="section-title"><h2>❓ Okur Anketi</h2></div>
<section class="poll">
    <h3>Sizce günün en önemli gündem maddesi hangisi?</h3>
    <p>Görüşünüzü paylaşın.</p>
    <label class="poll-option"><input type="radio" name="poll"> Ekonomi</label>
    <label class="poll-option"><input type="radio" name="poll"> Siyaset</label>
    <label class="poll-option"><input type="radio" name="poll"> Sağlık</label>
    <label class="poll-option"><input type="radio" name="poll"> Toplum</label>
    <label class="poll-option"><input type="radio" name="poll"> Dünya</label>
</section>

<div class="update">
    <span class="update-dot"></span>
    <span>Son güncelleme: <strong id="updateTime"></strong></span>
</div>
</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <strong>ŞAHİN UYMAZ</strong>
            <p>Haber • Gündem • Yorum • Analiz</p>
        </div>
        <div class="footer-links">
            <a href="#">Hakkımda</a>
            <a href="#">İletişim</a>
            <a href="#">Gizlilik</a>
            <a href="#">KVKK</a>
            <a href="admin.php">Admin</a>
        </div>
    </div>
</footer>

<script>
const now = new Date();
document.getElementById("date").textContent = now.toLocaleDateString("tr-TR",{day:"2-digit",month:"long",year:"numeric"});
document.getElementById("updateTime").textContent = new Date().toLocaleTimeString("tr-TR",{hour:"2-digit",minute:"2-digit"});

/* Son dakika */
const breakingNews = <?= json_encode(array_map(fn($n) => $n['title'], $breaking), JSON_UNESCAPED_UNICODE) ?>;
let breakingIndex = 0;
if (breakingNews.length > 1) {
    setInterval(function(){
        breakingIndex = (breakingIndex + 1) % breakingNews.length;
        document.getElementById("breakingText").textContent = breakingNews[breakingIndex];
    }, 4000);
}

/* Slider */
let currentSlide = 0;
const slides = document.querySelectorAll(".slide");
const dots = document.querySelectorAll(".slider-dot");
function goSlide(index){
    if (!slides.length) return;
    slides[currentSlide].classList.remove("active");
    if (dots[currentSlide]) dots[currentSlide].classList.remove("active");
    currentSlide = index;
    slides[currentSlide].classList.add("active");
    if (dots[currentSlide]) dots[currentSlide].classList.add("active");
}
if (slides.length > 1) {
    setInterval(function(){
        goSlide((currentSlide + 1) % slides.length);
    }, 6000);
}

function showPrediction(){
    document.getElementById("predictionResult").style.display = "block";
}
</script>
</body>
</html>
