<?php
require_once 'config.php';
$news = loadNews();
$id = $_GET['id'] ?? '';
$item = null;
foreach ($news as $n) {
    if ($n['id'] === $id) {
        $item = $n;
        break;
    }
}
if (!$item) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($item['title']) ?> | Şahin UYMAZ</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{--lacivert:#081b33;--mavi:#123f73;--kirmizi:#d71920;--acik:#f4f6f9;--gri:#667085;--border:#e4e7ec}
body{font-family:Inter,Arial,sans-serif;background:var(--acik);color:#111;line-height:1.6}
a{text-decoration:none;color:inherit}
.topbar{background:#061426;color:#cbd5e1;font-size:12px;padding:8px 0;text-align:center}
.header{background:#fff;border-bottom:1px solid var(--border);padding:18px 0}
.header-inner{width:94%;max-width:900px;margin:auto;display:flex;align-items:center;justify-content:space-between}
.logo strong{font-size:18px}
.logo span{display:block;font-size:10px;color:#667085;letter-spacing:1px}
.back{font-size:13px;font-weight:700;color:var(--mavi)}
.container{width:94%;max-width:800px;margin:40px auto 70px}
.category{display:inline-block;background:var(--kirmizi);color:#fff;padding:6px 12px;font-size:11px;font-weight:900;letter-spacing:.5px;margin-bottom:16px}
h1{font-family:"Playfair Display",serif;font-size:34px;line-height:1.2;margin-bottom:12px}
.meta{color:var(--gri);font-size:13px;margin-bottom:28px}
.hero-img{width:100%;max-height:420px;object-fit:cover;border-radius:8px;margin-bottom:28px;background:#e5e7eb}
.content{font-size:16px;line-height:1.8;color:#1f2937}
.content p{margin-bottom:16px}
footer{background:#061426;color:#9eb0c5;padding:30px;text-align:center;font-size:12px}
@media(max-width:600px){h1{font-size:26px}}
</style>
</head>
<body>
<div class="topbar">ŞAHİN UYMAZ | Haber • Gündem • Yorum • Analiz</div>
<header class="header">
    <div class="header-inner">
        <a href="index.php" class="logo">
            <strong>ŞAHİN UYMAZ</strong>
            <span>HABER • GÜNDEM • YORUM • ANALİZ</span>
        </a>
        <a href="index.php" class="back">← Ana Sayfa</a>
    </div>
</header>

<main class="container">
    <span class="category"><?= htmlspecialchars($item['category']) ?></span>
    <h1><?= htmlspecialchars($item['title']) ?></h1>
    <div class="meta"><?= date('d F Y, H:i', strtotime($item['date'])) ?></div>

    <?php if (!empty($item['image'])): ?>
    <img src="<?= htmlspecialchars($item['image']) ?>" alt="" class="hero-img">
    <?php endif; ?>

    <div class="content">
        <?php
        // Basit paragraf ayırma
        $paragraphs = preg_split('/\n+/', trim($item['content']));
        foreach ($paragraphs as $p) {
            if (trim($p) !== '') {
                echo '<p>' . nl2br(htmlspecialchars(trim($p))) . '</p>';
            }
        }
        ?>
    </div>
</main>

<footer>
    ŞAHİN UYMAZ — Haber • Gündem • Yorum • Analiz
</footer>
</body>
</html>
