<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// Hata raporlamayı açarak teknik aksaklıkları görmenizi sağlar
ini_set('display_errors', 0);
error_reporting(E_ALL);

$date = isset($_GET['date']) ? trim($_GET['date']) : '';
$name = isset($_GET['name']) ? trim($_GET['name']) : '';

if (empty($date)) {
    echo json_encode([
        'success' => false,
        'message' => 'Tarih parametresi eksik.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

/*
  Gaziantep Belediyesi / Kamusal veri kaynağınıza cURL ile istek atan bölüm.
  Aşağıdaki URL ve cURL yapısını kendi veri sağlayıcınızın servisine göre ayarlayabilirsiniz.
*/
$target_url = "https://www.gaziantep.bel.tr/api/defin/getir?tarih=" . urlencode($date);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL sertifika doğrulama hatasını aşmak için
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

if ($response === false || $http_code !== 200) {
    echo json_encode([
        'success' => false,
        'message' => 'Resmî veri kaynağına bağlanılamadı. (HTTP: ' . $http_code . ' - ' . $curl_error . ')'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Örnek dönen JSON formatı
$data = json_decode($response, true);

// İsim filtresi varsa PHP tarafında süzme (İsteğe bağlı)
$records = isset($data['records']) ? $data['records'] : [];

if (!empty($name) && is_array($records)) {
    $records = array_values(array_filter($records, function($item) use ($name) {
        return mb_stripos($item['name'], $name) !== false;
    }));
}

echo json_encode([
    'success' => true,
    'source' => 'Gaziantep Büyükşehir Belediyesi',
    'source_url' => 'https://www.gaziantep.bel.tr',
    'records' => $records
], JSON_UNESCAPED_UNICODE);
?>
