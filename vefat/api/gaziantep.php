<?php

/*
|--------------------------------------------------------------------------
| TÜRKİYE VEFAT BİLGİ MERKEZİ
| Gaziantep API
|--------------------------------------------------------------------------
|
| Dosya:
| vefat/api/gaziantep.php
|
| Görev:
| Gaziantep Büyükşehir Belediyesi'nin kamuya açık
| Günlük Defin Listesi sayfasından gerçek verileri almak.
|
| Örnek:
| gaziantep.php?name=Ahmet
|
|--------------------------------------------------------------------------
*/

header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


/*
|--------------------------------------------------------------------------
| OPTIONS isteği
|--------------------------------------------------------------------------
*/

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {

    http_response_code(204);
    exit;

}


/*
|--------------------------------------------------------------------------
| Aranan isim
|--------------------------------------------------------------------------
*/

$name = isset($_GET["name"])
    ? trim($_GET["name"])
    : "";


/*
|--------------------------------------------------------------------------
| İl bilgisi
|--------------------------------------------------------------------------
*/

$province = "Gaziantep";


/*
|--------------------------------------------------------------------------
| İsim kontrolü
|--------------------------------------------------------------------------
*/

if ($name === "") {

    echo json_encode(
        [
            "success" => false,
            "source" => "Gaziantep Büyükşehir Belediyesi",
            "message" => "Arama yapmak için ad veya soyad girilmelidir.",
            "records" => []
        ],
        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );

    exit;

}


/*
|--------------------------------------------------------------------------
| Çok kısa aramaları engelle
|--------------------------------------------------------------------------
|
| "A" gibi tek harfli aramalar çok fazla sonuç üretebilir.
|
*/

if (mb_strlen($name, "UTF-8") < 2) {

    echo json_encode(
        [
            "success" => false,
            "source" => "Gaziantep Büyükşehir Belediyesi",
            "message" => "Lütfen en az iki karakter girin.",
            "records" => []
        ],
        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );

    exit;

}


/*
|--------------------------------------------------------------------------
| Resmi kaynak
|--------------------------------------------------------------------------
*/

$sourceUrl = "https://gaziantep.bel.tr/index.php/tr/defin-listesi";


/*
|--------------------------------------------------------------------------
| Türkçe karakterleri karşılaştırma için normalize et
|--------------------------------------------------------------------------
*/

function normalizeTurkish($text)
{

    $text = trim($text);

    $text = mb_strtoupper($text, "UTF-8");

    $replace = [
        "İ" => "I",
        "I" => "I",
        "Ş" => "S",
        "Ğ" => "G",
        "Ü" => "U",
        "Ö" => "O",
        "Ç" => "C"
    ];

    return strtr($text, $replace);

}


/*
|--------------------------------------------------------------------------
| HTML temizleme
|--------------------------------------------------------------------------
*/

function cleanText($text)
{

    $text = html_entity_decode(
        $text,
        ENT_QUOTES | ENT_HTML5,
        "UTF-8"
    );

    $text = preg_replace("/\s+/u", " ", $text);

    return trim($text);

}


/*
|--------------------------------------------------------------------------
| Resmi sayfayı CURL ile çek
|--------------------------------------------------------------------------
*/

$ch = curl_init();

curl_setopt_array(
    $ch,
    [
        CURLOPT_URL => $sourceUrl,

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_FOLLOWLOCATION => true,

        CURLOPT_MAXREDIRS => 5,

        CURLOPT_CONNECTTIMEOUT => 15,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_SSL_VERIFYPEER => true,

        CURLOPT_SSL_VERIFYHOST => 2,

        CURLOPT_ENCODING => "",

        CURLOPT_USERAGENT =>
            "Mozilla/5.0 (Windows NT 10.0; Win64; x64) " .
            "AppleWebKit/537.36 (KHTML, like Gecko) " .
            "Chrome/153.0 Safari/537.36 " .
            "Türkiye Vefat Bilgi Merkezi",

        CURLOPT_HTTPHEADER => [
            "Accept: text/html,application/xhtml+xml",
            "Accept-Language: tr-TR,tr;q=0.9"
        ]
    ]
);


$html = curl_exec($ch);

$curlError = curl_error($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);


/*
|--------------------------------------------------------------------------
| Kaynak erişim kontrolü
|--------------------------------------------------------------------------
*/

if ($html === false || $html === "" || $httpCode < 200 || $httpCode >= 400) {

    echo json_encode(
        [
            "success" => false,
            "source" => "Gaziantep Büyükşehir Belediyesi",
            "source_url" => $sourceUrl,
            "message" =>
                "Gaziantep Büyükşehir Belediyesi'nin resmi veri kaynağına şu anda erişilemedi.",
            "records" => []
        ],
        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );

    exit;

}


/*
|--------------------------------------------------------------------------
| DOMDocument ile HTML'i oku
|--------------------------------------------------------------------------
*/

libxml_use_internal_errors(true);

$dom = new DOMDocument();

$loaded = $dom->loadHTML(
    '<?xml encoding="UTF-8">' . $html,
    LIBXML_NOWARNING | LIBXML_NOERROR
);

libxml_clear_errors();


if (!$loaded) {

    echo json_encode(
        [
            "success" => false,
            "source" => "Gaziantep Büyükşehir Belediyesi",
            "source_url" => $sourceUrl,
            "message" => "Resmi veri sayfasının yapısı okunamadı.",
            "records" => []
        ],
        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );

    exit;

}


/*
|--------------------------------------------------------------------------
| XPath
|--------------------------------------------------------------------------
*/

$xpath = new DOMXPath($dom);


/*
|--------------------------------------------------------------------------
| Sonuçları tutacağımız dizi
|--------------------------------------------------------------------------
*/

$records = [];


/*
|--------------------------------------------------------------------------
| Tabloları bul
|--------------------------------------------------------------------------
*/

$tables = $xpath->query("//table");


foreach ($tables as $table) {

    $rows = $xpath->query(".//tr", $table);


    foreach ($rows as $row) {

        $cells = $xpath->query("./th|./td", $row);


        /*
        |--------------------------------------------------------------------------
        | En az 6 hücre olması bekleniyor
        |
        | Adı Soyadı
        | Cinsiyet
        | Baba / Ana Adı
        | Doğum Yılı
        | Vefat Tarihi / Yaşı
        | Defin Yeri
        |--------------------------------------------------------------------------
        */

        if ($cells->length < 6) {
            continue;
        }


        $values = [];


        foreach ($cells as $cell) {

            $values[] = cleanText(
                $cell->textContent
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Başlık satırını atla
        |--------------------------------------------------------------------------
        */

        $first = normalizeTurkish($values[0]);

        if (
            strpos($first, "ADI") !== false ||
            strpos($first, "SOYADI") !== false ||
            strpos($first, "AD SOYAD") !== false
        ) {
            continue;
        }


        /*
        |--------------------------------------------------------------------------
        | Alanları al
        |--------------------------------------------------------------------------
        */

        $personName = $values[0];

        $gender = $values[1];

        $parentNames = $values[2];

        $birthYear = $values[3];

        $deathInfo = $values[4];

        $burialPlace = $values[5];


        /*
        |--------------------------------------------------------------------------
        | Boş satırları geç
        |--------------------------------------------------------------------------
        */

        if ($personName === "") {
            continue;
        }


        /*
        |--------------------------------------------------------------------------
        | Arama
        |--------------------------------------------------------------------------
        */

        $normalizedPerson =
            normalizeTurkish($personName);

        $normalizedSearch =
            normalizeTurkish($name);


        /*
        |--------------------------------------------------------------------------
        | Ad veya soyad içinde arama
        |--------------------------------------------------------------------------
        */

        if (
            mb_strpos(
                $normalizedPerson,
                $normalizedSearch,
                0,
                "UTF-8"
            ) === false
        ) {

            continue;

        }


        /*
        |--------------------------------------------------------------------------
        | Vefat tarihi ve yaşı ayır
        |--------------------------------------------------------------------------
        |
        | Örnek:
        | 16.09.2026 / 61
        |
        */

        $deathDate = $deathInfo;

        $age = "";


        if (strpos($deathInfo, "/") !== false) {

            $parts = explode("/", $deathInfo, 2);

            $deathDate = trim($parts[0]);

            $age = trim($parts[1]);

        }


        /*
        |--------------------------------------------------------------------------
        | Kayıt
        |--------------------------------------------------------------------------
        */

        $records[] = [

            "name" => $personName,

            "province" => $province,

            "district" => "",

            "gender" => $gender,

            "parentNames" => $parentNames,

            "birthYear" => $birthYear,

            "deathDate" => $deathDate,

            "age" => $age,

            "burialPlace" => $burialPlace,

            "source" =>
                "Gaziantep Büyükşehir Belediyesi",

            "sourceUrl" =>
                $sourceUrl

        ];

    }

}


/*
|--------------------------------------------------------------------------
| Aynı kayıtların tekrarını engelle
|--------------------------------------------------------------------------
*/

$unique = [];

$finalRecords = [];


foreach ($records as $record) {

    $key =
        normalizeTurkish($record["name"]) .
        "|" .
        $record["deathDate"] .
        "|" .
        $record["burialPlace"];


    if (isset($unique[$key])) {
        continue;
    }


    $unique[$key] = true;

    $finalRecords[] = $record;

}


/*
|--------------------------------------------------------------------------
| JSON cevabı
|--------------------------------------------------------------------------
*/

echo json_encode(
    [
        "success" => true,

        "province" => $province,

        "source" =>
            "Gaziantep Büyükşehir Belediyesi",

        "source_url" =>
            $sourceUrl,

        "search" =>
            $name,

        "count" =>
            count($finalRecords),

        "records" =>
            $finalRecords

    ],
    JSON_UNESCAPED_UNICODE |
    JSON_UNESCAPED_SLASHES |
    JSON_PRETTY_PRINT
);

?>
