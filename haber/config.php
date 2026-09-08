<?php
// Basit yapılandırma
session_start();

define('DATA_FILE', __DIR__ . '/data/news.json');
define('UPLOAD_DIR', __DIR__ . '/uploads/');
define('ADMIN_PASSWORD', 'sahin2026'); // Admin şifresi - değiştirebilirsiniz

// Klasörler yoksa oluştur
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0755, true);
}
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

// Haberleri yükle
function loadNews() {
    if (!file_exists(DATA_FILE)) {
        return [];
    }
    $json = file_get_contents(DATA_FILE);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

// Haberleri kaydet
function saveNews($news) {
    // En yeni haberler üste gelsin
    usort($news, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    file_put_contents(DATA_FILE, json_encode($news, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Admin giriş kontrolü
function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}

function requireAdmin() {
    if (!isAdmin()) {
        header('Location: admin.php');
        exit;
    }
}
?>
