<?php
require_once 'config.php';

// Çıkış
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Giriş işlemi
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    if ($_POST['password'] === ADMIN_PASSWORD) {
        $_SESSION['admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Şifre hatalı!';
    }
}

// Haber silme
if (isAdmin() && isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $news = loadNews();
    $news = array_filter($news, function($item) use ($id) {
        return $item['id'] !== $id;
    });
    saveNews(array_values($news));
    header('Location: admin.php?msg=silindi');
    exit;
}

// Haber ekleme / güncelleme
if (isAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_news'])) {
    $news = loadNews();
    $id = $_POST['id'] ?? uniqid();
    $imagePath = $_POST['existing_image'] ?? '';

    // Resim yükleme
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed)) {
            $filename = uniqid() . '.' . $ext;
            $target = UPLOAD_DIR . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $imagePath = 'uploads/' . $filename;
            }
        }
    }

    $item = [
        'id' => $id,
        'title' => trim($_POST['title']),
        'category' => $_POST['category'],
        'summary' => trim($_POST['summary']),
        'content' => trim($_POST['content']),
        'image' => $imagePath,
        'date' => $_POST['date'] ?: date('Y-m-d H:i:s'),
        'featured' => isset($_POST['featured']) ? true : false
    ];

    // Güncelleme mi yoksa yeni mi?
    $found = false;
    foreach ($news as &$n) {
        if ($n['id'] === $id) {
            $n = $item;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $news[] = $item;
    }

    saveNews($news);
    header('Location: admin.php?msg=kaydedildi');
    exit;
}

// Düzenleme için haber çek
$editItem = null;
if (isAdmin() && isset($_GET['edit'])) {
    $news = loadNews();
    foreach ($news as $n) {
        if ($n['id'] === $_GET['edit']) {
            $editItem = $n;
            break;
        }
    }
}

$allNews = isAdmin() ? loadNews() : [];
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin | Şahin UYMAZ</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box}
:root{--lacivert:#081b33;--mavi:#123f73;--kirmizi:#d71920;--acik:#f4f6f9;--border:#e4e7ec}
body{font-family:Inter,Arial,sans-serif;background:var(--acik);color:#111;line-height:1.5}
.container{max-width:900px;margin:40px auto;padding:0 20px}
.login-box{background:#fff;border:1px solid var(--border);border-radius:10px;padding:40px;max-width:400px;margin:80px auto;text-align:center}
.login-box h1{font-size:22px;margin-bottom:8px;color:var(--lacivert)}
.login-box p{color:#667085;font-size:13px;margin-bottom:25px}
input[type=password],input[type=text],input[type=datetime-local],select,textarea{
    width:100%;padding:12px 14px;border:1px solid var(--border);border-radius:6px;font-size:14px;margin-bottom:14px;font-family:inherit
}
textarea{min-height:120px;resize:vertical}
button,.btn{display:inline-block;padding:12px 20px;background:var(--lacivert);color:#fff;border:0;border-radius:6px;font-size:13px;font-weight:700;cursor:pointer;text-decoration:none}
button:hover,.btn:hover{background:var(--mavi)}
.btn-red{background:var(--kirmizi)}
.btn-gray{background:#667085}
.error{background:#fef2f2;color:#b91c1c;padding:10px;border-radius:6px;margin-bottom:15px;font-size:13px}
.success{background:#f0fdf4;color:#166534;padding:10px;border-radius:6px;margin-bottom:15px;font-size:13px}
header{background:var(--lacivert);color:#fff;padding:16px 0;margin-bottom:30px}
header .inner{max-width:900px;margin:auto;padding:0 20px;display:flex;justify-content:space-between;align-items:center}
header a{color:#cbd5e1;font-size:13px;text-decoration:none;margin-left:15px}
.card{background:#fff;border:1px solid var(--border);border-radius:10px;padding:28px;margin-bottom:24px}
.card h2{font-size:18px;margin-bottom:18px;color:var(--lacivert)}
label{display:block;font-size:12px;font-weight:600;margin-bottom:5px;color:#374151}
.form-row{margin-bottom:4px}
.check{display:flex;align-items:center;gap:8px;margin:12px 0}
.check input{width:auto;margin:0}
.news-list{list-style:none}
.news-list li{display:flex;align-items:center;gap:14px;padding:14px 0;border-bottom:1px solid var(--border)}
.news-list li:last-child{border-bottom:0}
.thumb{width:70px;height:50px;object-fit:cover;border-radius:4px;background:#e5e7eb}
.news-info{flex:1}
.news-info strong{display:block;font-size:14px}
.news-info span{font-size:11px;color:#667085}
.actions a{font-size:12px;margin-left:8px;color:var(--mavi);text-decoration:none}
.actions a.del{color:var(--kirmizi)}
.badge{display:inline-block;background:#fee2e2;color:var(--kirmizi);font-size:10px;font-weight:700;padding:2px 7px;border-radius:4px;margin-left:6px}
</style>
</head>
<body>

<?php if (!isAdmin()): ?>
<!-- GİRİŞ EKRANI -->
<div class="login-box">
    <h1>ŞAHİN UYMAZ</h1>
    <p>Admin Paneli</p>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form method="post">
        <input type="password" name="password" placeholder="Şifre" required autofocus>
        <button type="submit" name="login" style="width:100%">Giriş Yap</button>
    </form>
    <p style="margin-top:20px;font-size:11px;color:#9ca3af">Varsayılan şifre: <strong>sahin2026</strong></p>
</div>

<?php else: ?>
<!-- ADMIN PANELİ -->
<header>
    <div class="inner">
        <strong>Admin Paneli</strong>
        <div>
            <a href="index.php" target="_blank">Siteyi Görüntüle →</a>
            <a href="?logout=1">Çıkış</a>
        </div>
    </div>
</header>

<div class="container">
    <?php if ($msg === 'kaydedildi'): ?>
        <div class="success">✓ Haber başarıyla kaydedildi.</div>
    <?php elseif ($msg === 'silindi'): ?>
        <div class="success">✓ Haber silindi.</div>
    <?php endif; ?>

    <!-- HABER EKLE / DÜZENLE -->
    <div class="card">
        <h2><?= $editItem ? 'Haberi Düzenle' : 'Yeni Haber Ekle' ?></h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($editItem['id'] ?? '') ?>">
            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($editItem['image'] ?? '') ?>">

            <div class="form-row">
                <label>Başlık *</label>
                <input type="text" name="title" required value="<?= htmlspecialchars($editItem['title'] ?? '') ?>">
            </div>

            <div class="form-row">
                <label>Kategori *</label>
                <select name="category" required>
                    <?php
                    $cats = ['Gündem','Siyaset','Ekonomi','Sağlık','Spor','Dünya','Toplum','Yorum'];
                    $selected = $editItem['category'] ?? 'Gündem';
                    foreach ($cats as $c) {
                        echo '<option value="'.$c.'"'.($c===$selected?' selected':'').'>'.$c.'</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-row">
                <label>Kısa Özet (kartlarda görünür)</label>
                <input type="text" name="summary" value="<?= htmlspecialchars($editItem['summary'] ?? '') ?>">
            </div>

            <div class="form-row">
                <label>Haber Metni *</label>
                <textarea name="content" required><?= htmlspecialchars($editItem['content'] ?? '') ?></textarea>
            </div>

            <div class="form-row">
                <label>Resim</label>
                <?php if (!empty($editItem['image'])): ?>
                    <p style="font-size:12px;margin-bottom:8px">Mevcut: <img src="<?= htmlspecialchars($editItem['image']) ?>" style="height:40px;vertical-align:middle;border-radius:3px"></p>
                <?php endif; ?>
                <input type="file" name="image" accept="image/*">
            </div>

            <div class="form-row">
                <label>Tarih</label>
                <input type="datetime-local" name="date" value="<?= isset($editItem['date']) ? date('Y-m-d\TH:i', strtotime($editItem['date'])) : date('Y-m-d\TH:i') ?>">
            </div>

            <div class="check">
                <input type="checkbox" name="featured" id="featured" <?= (!empty($editItem['featured'])) ? 'checked' : '' ?>>
                <label for="featured" style="margin:0">Gündem slider'da göster (öne çıkan)</label>
            </div>

            <button type="submit" name="save_news"><?= $editItem ? 'Güncelle' : 'Kaydet' ?></button>
            <?php if ($editItem): ?>
                <a href="admin.php" class="btn btn-gray" style="margin-left:8px">İptal</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- MEVCUT HABERLER -->
    <div class="card">
        <h2>Kayıtlı Haberler (<?= count($allNews) ?>)</h2>
        <?php if (empty($allNews)): ?>
            <p style="color:#667085;font-size:14px">Henüz haber yok. Yukarıdan ekleyin.</p>
        <?php else: ?>
            <ul class="news-list">
                <?php foreach ($allNews as $n): ?>
                <li>
                    <?php if (!empty($n['image'])): ?>
                        <img src="<?= htmlspecialchars($n['image']) ?>" class="thumb" alt="">
                    <?php else: ?>
                        <div class="thumb"></div>
                    <?php endif; ?>
                    <div class="news-info">
                        <strong>
                            <?= htmlspecialchars($n['title']) ?>
                            <?php if (!empty($n['featured'])): ?><span class="badge">SLIDER</span><?php endif; ?>
                        </strong>
                        <span><?= htmlspecialchars($n['category']) ?> • <?= date('d.m.Y H:i', strtotime($n['date'])) ?></span>
                    </div>
                    <div class="actions">
                        <a href="?edit=<?= urlencode($n['id']) ?>">Düzenle</a>
                        <a href="?delete=<?= urlencode($n['id']) ?>" class="del" onclick="return confirm('Silmek istediğinize emin misiniz?')">Sil</a>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
</body>
</html>
