<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Türkiye Vefat Bilgi Merkezi | Vefat ve Defin Bilgileri</title>

<meta name="description" content="Türkiye genelinde kamuya açık olarak yayımlanan vefat ve defin bilgilerini tek noktadan arayın.">
<meta name="robots" content="index, follow">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">

<style>

:root {
    --navy: #081525;
    --navy-2: #0d2035;
    --blue: #163b5c;
    --blue-light: #eaf2f8;
    --red: #b4232f;
    --red-dark: #8e1721;
    --gold: #c9a45c;
    --white: #ffffff;
    --text: #1d2939;
    --muted: #667085;
    --border: #d9e1e8;
    --bg: #f4f7fa;
    --success: #157347;
    --shadow: 0 18px 45px rgba(8, 21, 37, 0.10);
}

* {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
    background: var(--bg);
    color: var(--text);
    font-family: "Inter", Arial, sans-serif;
}

.top-strip {
    height: 5px;
    background: linear-gradient(
        90deg,
        var(--red) 0%,
        var(--red) 45%,
        var(--gold) 45%,
        var(--gold) 55%,
        var(--red) 55%,
        var(--red) 100%
    );
}

header {
    background:
        linear-gradient(
            135deg,
            rgba(8, 21, 37, 0.98),
            rgba(13, 32, 53, 0.96)
        );
    color: white;
    padding: 24px 20px 85px;
    position: relative;
    overflow: hidden;
}

header::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 50%;
    right: -180px;
    top: -230px;
}

header::after {
    content: "";
    position: absolute;
    width: 350px;
    height: 350px;
    border: 1px solid rgba(201,164,92,0.08);
    border-radius: 50%;
    left: -180px;
    bottom: -260px;
}

.header-inner {
    max-width: 1180px;
    margin: auto;
    position: relative;
    z-index: 2;
}

.brand {
    display: flex;
    align-items: center;
    gap: 15px;
}

.brand-symbol {
    width: 48px;
    height: 48px;
    border: 1px solid rgba(201,164,92,0.65);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    font-size: 22px;
    font-weight: 700;
}

.brand-text strong {
    display: block;
    font-size: 14px;
    letter-spacing: 1.8px;
    color: #e7edf3;
}

.brand-text span {
    display: block;
    margin-top: 4px;
    font-size: 12px;
    color: #aebdcc;
}

.hero {
    max-width: 850px;
    margin: 65px auto 0;
    text-align: center;
}

.hero .eyebrow {
    display: inline-block;
    border: 1px solid rgba(201,164,92,0.45);
    color: #e4c985;
    padding: 8px 16px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 1.4px;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.hero h1 {
    margin: 0;
    font-family: "Playfair Display", Georgia, serif;
    font-size: clamp(38px, 6vw, 66px);
    line-height: 1.08;
    font-weight: 700;
}

.hero h1 span {
    color: #dfbd73;
}

.hero p {
    max-width: 680px;
    margin: 22px auto 0;
    color: #c4d0dc;
    font-size: 16px;
    line-height: 1.8;
}


/* =========================
   ARAMA
========================= */

.search-wrapper {
    max-width: 1080px;
    margin: -50px auto 0;
    padding: 0 20px;
    position: relative;
    z-index: 10;
}

.search-card {
    background: var(--white);
    border-radius: 18px;
    box-shadow: var(--shadow);
    border: 1px solid rgba(8,21,37,0.08);
    padding: 28px;
}

.search-title {
    margin-bottom: 23px;
}

.search-title h2 {
    margin: 0;
    font-size: 21px;
    color: var(--navy);
}

.search-title p {
    margin: 7px 0 0;
    color: var(--muted);
    font-size: 13px;
}

.search-grid {
    display: grid;
    grid-template-columns: 1.15fr 1fr 1fr;
    gap: 14px;
}

.field label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #344054;
    margin-bottom: 8px;
}

.field select,
.field input {
    width: 100%;
    height: 52px;
    border: 1px solid var(--border);
    background: #fbfcfd;
    border-radius: 10px;
    padding: 0 15px;
    font-family: inherit;
    font-size: 14px;
    color: var(--text);
    outline: none;
    transition: 0.2s ease;
}

.field select:focus,
.field input:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px rgba(22,59,92,0.08);
    background: white;
}


/* HIZLI TARİH */

.quick-date {
    margin-top: 19px;
}

.quick-date-title {
    font-size: 12px;
    font-weight: 700;
    color: #344054;
    margin-bottom: 9px;
}

.quick-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.quick-button {
    border: 1px solid #d6dee6;
    background: #f8fafc;
    color: #344054;
    border-radius: 8px;
    padding: 9px 13px;
    font-family: inherit;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}

.quick-button:hover {
    border-color: var(--blue);
    color: var(--blue);
}

.quick-button.active {
    background: var(--blue);
    color: white;
    border-color: var(--blue);
}


/* ARAMA BUTONU */

.search-button-wrap {
    margin-top: 19px;
}

.search-button {
    width: 100%;
    height: 54px;
    border: 0;
    border-radius: 10px;
    background: var(--red);
    color: white;
    font-family: inherit;
    font-size: 14px;
    font-weight: 800;
    cursor: pointer;
    transition: 0.2s ease;
}

.search-button:hover {
    background: var(--red-dark);
    transform: translateY(-1px);
}

.search-button:disabled {
    opacity: 0.65;
    cursor: wait;
    transform: none;
}


/* =========================
   ANA İÇERİK
========================= */

main {
    max-width: 1080px;
    margin: 42px auto 80px;
    padding: 0 20px;
}

.info-panel {
    background: white;
    border: 1px solid var(--border);
    border-radius: 15px;
    padding: 21px 23px;
    display: flex;
    gap: 15px;
    align-items: flex-start;
}

.info-icon {
    width: 38px;
    height: 38px;
    flex: 0 0 38px;
    border-radius: 50%;
    background: var(--blue-light);
    color: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
}

.info-panel strong {
    display: block;
    margin-bottom: 5px;
    color: var(--navy);
    font-size: 14px;
}

.info-panel p {
    margin: 0;
    color: var(--muted);
    font-size: 13px;
    line-height: 1.7;
}


/* =========================
   SONUÇ BAŞLIĞI
========================= */

.results-header {
    margin: 38px 0 17px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
}

.results-header h2 {
    margin: 0;
    font-size: 21px;
    color: var(--navy);
}

.result-count {
    display: none;
    background: #eef5f0;
    color: var(--success);
    padding: 7px 11px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
}


/* =========================
   BOŞ DURUM
========================= */

.empty-state {
    background: white;
    border: 1px dashed #c9d3dd;
    border-radius: 15px;
    padding: 52px 25px;
    text-align: center;
}

.empty-symbol {
    width: 64px;
    height: 64px;
    margin: 0 auto 18px;
    border-radius: 50%;
    background: #edf2f6;
    color: var(--blue);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 27px;
}

.empty-state h3 {
    margin: 0;
    font-size: 18px;
    color: var(--navy);
}

.empty-state p {
    max-width: 650px;
    margin: 10px auto 0;
    color: var(--muted);
    font-size: 13px;
    line-height: 1.7;
}


/* =========================
   YÜKLENİYOR
========================= */

.loading {
    display: none;
    background: white;
    border-radius: 15px;
    border: 1px solid var(--border);
    padding: 45px;
    text-align: center;
}

.spinner {
    width: 38px;
    height: 38px;
    border: 4px solid #e4e9ee;
    border-top-color: var(--red);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin: 0 auto 15px;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.loading p {
    margin: 0;
    color: var(--muted);
    font-size: 13px;
}


/* =========================
   SONUÇ KARTLARI
========================= */

.results {
    display: grid;
    gap: 14px;
}

.result-card {
    background: white;
    border: 1px solid var(--border);
    border-radius: 15px;
    padding: 22px;
    box-shadow: 0 5px 20px rgba(8,21,37,0.035);
}

.result-top {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    align-items: flex-start;
}

.result-name {
    margin: 0;
    color: var(--navy);
    font-size: 18px;
    font-weight: 800;
}

.result-location {
    margin-top: 6px;
    color: var(--muted);
    font-size: 13px;
}

.source-badge {
    flex-shrink: 0;
    padding: 6px 10px;
    background: #f0f4f7;
    color: var(--blue);
    border-radius: 7px;
    font-size: 11px;
    font-weight: 700;
}

.result-details {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 19px;
    padding-top: 18px;
    border-top: 1px solid #edf0f3;
}

.detail {
    min-width: 0;
}

.detail-label {
    display: block;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.6px;
    color: #98a2b3;
    font-weight: 700;
    margin-bottom: 5px;
}

.detail-value {
    display: block;
    font-size: 13px;
    color: #344054;
    font-weight: 600;
}

.source-link {
    display: inline-flex;
    margin-top: 17px;
    color: var(--red);
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
}

.source-link:hover {
    text-decoration: underline;
}


/* =========================
   HATA
========================= */

.error-state {
    display: none;
    background: #fff8f8;
    border: 1px solid #f1caca;
    border-radius: 15px;
    padding: 24px;
}

.error-state strong {
    display: block;
    color: #8e1721;
    margin-bottom: 7px;
}

.error-state p {
    margin: 0;
    color: #6d3c40;
    font-size: 13px;
    line-height: 1.7;
}


/* =========================
   FOOTER
========================= */

footer {
    background: var(--navy);
    color: #aebdcc;
    padding: 35px 20px;
}

.footer-inner {
    max-width: 1080px;
    margin: auto;
}

.footer-title {
    color: white;
    font-weight: 800;
    font-size: 14px;
    margin-bottom: 10px;
}

footer p {
    max-width: 850px;
    margin: 0;
    font-size: 12px;
    line-height: 1.8;
}

.footer-bottom {
    border-top: 1px solid rgba(255,255,255,0.08);
    margin-top: 24px;
    padding-top: 18px;
    font-size: 11px;
    color: #8292a4;
}


/* =========================
   MOBİL
========================= */

@media (max-width: 850px) {

    header {
        padding-bottom: 75px;
    }

    .hero {
        margin-top: 48px;
    }

    .search-grid {
        grid-template-columns: 1fr;
    }

    .search-card {
        padding: 21px;
    }

    .result-details {
        grid-template-columns: repeat(2, 1fr);
    }

}

@media (max-width: 550px) {

    .brand-text strong {
        font-size: 12px;
    }

    .hero h1 {
        font-size: 39px;
    }

    .hero p {
        font-size: 14px;
    }

    .search-wrapper {
        padding: 0 12px;
    }

    main {
        padding: 0 12px;
    }

    .info-panel {
        padding: 17px;
    }

    .result-details {
        grid-template-columns: 1fr;
    }

    .quick-button {
        flex: 1 1 auto;
    }

}

</style>
</head>

<body>

<div class="top-strip"></div>


<header>

    <div class="header-inner">

        <div class="brand">

            <div class="brand-symbol">
                †
            </div>

            <div class="brand-text">

                <strong>
                    TÜRKİYE VEFAT BİLGİ MERKEZİ
                </strong>

                <span>
                    Kamuya açık vefat ve defin bilgileri
                </span>

            </div>

        </div>


        <div class="hero">

            <div class="eyebrow">
                Açık Kamu Verileri
            </div>

            <h1>
                Türkiye Vefat<br>
                <span>Bilgi Merkezi</span>
            </h1>

            <p>
                Türkiye genelinde kamuya açık olarak yayımlanan
                vefat ve defin bilgilerini tek noktadan arayın.
            </p>

        </div>

    </div>

</header>


<!-- =====================================================
     ARAMA ALANI
===================================================== -->

<section class="search-wrapper">

    <div class="search-card">

        <div class="search-title">

            <h2>
                Vefat ve Defin Bilgisi Arama
            </h2>

            <p>
                Tarih seçerek o güne ait kamuya açık kayıtları
                görüntüleyebilir, isterseniz kişi adıyla
                sonuçları daraltabilirsiniz.
            </p>

        </div>


        <form id="searchForm">


            <div class="search-grid">


                <!-- İL -->

                <div class="field">

                    <label for="province">
                        İl
                    </label>

                    <select id="province">

                        <option value="turkiye">
                            Türkiye Geneli
                        </option>

                        <option value="adana">Adana</option>
                        <option value="adiyaman">Adıyaman</option>
                        <option value="afyonkarahisar">Afyonkarahisar</option>
                        <option value="agri">Ağrı</option>
                        <option value="amasya">Amasya</option>
                        <option value="ankara">Ankara</option>
                        <option value="antalya">Antalya</option>
                        <option value="artvin">Artvin</option>
                        <option value="aydin">Aydın</option>
                        <option value="balikesir">Balıkesir</option>
                        <option value="bilecik">Bilecik</option>
                        <option value="bingol">Bingöl</option>
                        <option value="bitlis">Bitlis</option>
                        <option value="bolu">Bolu</option>
                        <option value="burdur">Burdur</option>
                        <option value="bursa">Bursa</option>
                        <option value="canakkale">Çanakkale</option>
                        <option value="cankiri">Çankırı</option>
                        <option value="corum">Çorum</option>
                        <option value="denizli">Denizli</option>
                        <option value="diyarbakir">Diyarbakır</option>
                        <option value="edirne">Edirne</option>
                        <option value="elazig">Elazığ</option>
                        <option value="erzincan">Erzincan</option>
                        <option value="erzurum">Erzurum</option>
                        <option value="eskisehir">Eskişehir</option>

                        <option value="gaziantep">
                            Gaziantep
                        </option>

                        <option value="giresun">Giresun</option>
                        <option value="gumushane">Gümüşhane</option>
                        <option value="hakkari">Hakkâri</option>
                        <option value="hatay">Hatay</option>
                        <option value="igdir">Iğdır</option>
                        <option value="isparta">Isparta</option>
                        <option value="istanbul">İstanbul</option>
                        <option value="izmir">İzmir</option>
                        <option value="kahramanmaras">Kahramanmaraş</option>
                        <option value="karabuk">Karabük</option>
                        <option value="karaman">Karaman</option>
                        <option value="kars">Kars</option>
                        <option value="kastamonu">Kastamonu</option>
                        <option value="kayseri">Kayseri</option>
                        <option value="kilis">Kilis</option>
                        <option value="kirikkale">Kırıkkale</option>
                        <option value="kirklareli">Kırklareli</option>
                        <option value="kirsehir">Kırşehir</option>
                        <option value="kocaeli">Kocaeli</option>
                        <option value="konya">Konya</option>
                        <option value="kutahya">Kütahya</option>
                        <option value="malatya">Malatya</option>
                        <option value="manisa">Manisa</option>
                        <option value="mardin">Mardin</option>
                        <option value="mersin">Mersin</option>
                        <option value="mugla">Muğla</option>
                        <option value="mus">Muş</option>
                        <option value="nevsehir">Nevşehir</option>
                        <option value="nigde">Niğde</option>
                        <option value="ordu">Ordu</option>
                        <option value="osmaniye">Osmaniye</option>
                        <option value="rize">Rize</option>
                        <option value="sakarya">Sakarya</option>
                        <option value="samsun">Samsun</option>
                        <option value="siirt">Siirt</option>
                        <option value="sinop">Sinop</option>
                        <option value="sivas">Sivas</option>
                        <option value="sanliurfa">Şanlıurfa</option>
                        <option value="sirnak">Şırnak</option>
                        <option value="tekirdag">Tekirdağ</option>
                        <option value="tokat">Tokat</option>
                        <option value="trabzon">Trabzon</option>
                        <option value="tunceli">Tunceli</option>
                        <option value="usak">Uşak</option>
                        <option value="van">Van</option>
                        <option value="yalova">Yalova</option>
                        <option value="yozgat">Yozgat</option>
                        <option value="zonguldak">Zonguldak</option>

                    </select>

                </div>


                <!-- HIZLI TARİH -->

                <div class="field">

                    <label for="quickDate">
                        Hızlı Tarih
                    </label>

                    <select id="quickDate">

                        <option value="">
                            Tarih seçin
                        </option>

                        <option value="today">
                            Bugün
                        </option>

                        <option value="yesterday">
                            Dün
                        </option>

                        <option value="beforeYesterday">
                            Önceki Gün
                        </option>

                        <option value="last3">
                            Son 3 Gün
                        </option>

                        <option value="last7">
                            Son 7 Gün
                        </option>

                    </select>

                </div>


                <!-- AD SOYAD -->

                <div class="field">

                    <label for="name">
                        Ad Soyad
                        <span style="font-weight:400;color:#98a2b3;">
                            (İsteğe bağlı)
                        </span>
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Örneğin: Ahmet Yılmaz"
                        autocomplete="off"
                    >

                </div>

            </div>


            <!-- TAKVİM -->

            <div
                class="field"
                style="margin-top:19px;"
            >

                <label for="selectedDate">
                    Belirli Tarih
                </label>

                <input
                    type="date"
                    id="selectedDate"
                >

            </div>


            <!-- HIZLI TARİH BUTONLARI -->

            <div class="quick-date">

                <div class="quick-date-title">
                    Hızlı tarih seçimi
                </div>

                <div class="quick-buttons">

                    <button
                        type="button"
                        class="quick-button"
                        data-period="today"
                    >
                        Bugün
                    </button>

                    <button
                        type="button"
                        class="quick-button"
                        data-period="yesterday"
                    >
                        Dün
                    </button>

                    <button
                        type="button"
                        class="quick-button"
                        data-period="beforeYesterday"
                    >
                        Önceki Gün
                    </button>

                    <button
                        type="button"
                        class="quick-button"
                        data-period="last3"
                    >
                        Son 3 Gün
                    </button>

                    <button
                        type="button"
                        class="quick-button"
                        data-period="last7"
                    >
                        Son 7 Gün
                    </button>

                </div>

            </div>


            <!-- ARAMA -->

            <div class="search-button-wrap">

                <button
                    type="submit"
                    class="search-button"
                    id="searchButton"
                >
                    VEFAT EDENLERİ GÖSTER
                </button>

            </div>


        </form>

    </div>

</section>


<!-- =====================================================
     ANA İÇERİK
===================================================== -->

<main>


    <div class="info-panel">

        <div class="info-icon">
            i
        </div>

        <div>

            <strong>
                Önemli bilgi
            </strong>

            <p>
                Türkiye Vefat Bilgi Merkezi yalnızca kamuya açık olarak
                yayımlanan ve teknik olarak erişilebilen vefat ve defin
                bilgilerini sunmayı amaçlar. Kapalı, giriş gerektiren veya
                dışarıdan erişime izin vermeyen veri kaynakları sisteme
                dahil edilmez. Bir kişinin burada bulunmaması, kişinin
                vefat etmediği anlamına gelmez.
            </p>

        </div>

    </div>


    <div class="results-header">

        <h2>
            Arama Sonuçları
        </h2>

        <span
            class="result-count"
            id="resultCount"
        ></span>

    </div>


    <!-- BAŞLANGIÇ -->

    <div
        class="empty-state"
        id="emptyState"
    >

        <div class="empty-symbol">
            🔎
        </div>

        <h3>
            Vefat ve defin bilgisi arayın
        </h3>

        <p>
            İl ve tarih seçin. Ad Soyad alanını boş bırakırsanız
            seçtiğiniz tarihteki erişilebilen kayıtlar gösterilir.
            Belirli bir kişiyi arıyorsanız Ad Soyad alanını da
            doldurabilirsiniz.
        </p>

    </div>


    <!-- YÜKLENİYOR -->

    <div
        class="loading"
        id="loadingState"
    >

        <div class="spinner"></div>

        <p>
            Kamuya açık kaynaklar kontrol ediliyor...
        </p>

    </div>


    <!-- HATA -->

    <div
        class="error-state"
        id="errorState"
    >

        <strong>
            Arama sırasında bir sorun oluştu.
        </strong>

        <p id="errorMessage"></p>

    </div>


    <!-- SONUÇLAR -->

    <div
        class="results"
        id="results"
    ></div>

</main>


<footer>

    <div class="footer-inner">

        <div class="footer-title">
            Türkiye Vefat Bilgi Merkezi
        </div>

        <p>
            Bu platform, kamu kurumları ve yerel yönetimler tarafından
            kamuya açık olarak yayımlanan vefat ve defin bilgilerinin
            daha kolay aranabilmesini amaçlayan bir bilgi merkezidir.
        </p>

        <div class="footer-bottom">
            © 2026 Türkiye Vefat Bilgi Merkezi
        </div>

    </div>

</footer>


<script>

/* =========================================================
   ELEMENTLER
========================================================= */

const searchForm =
    document.getElementById("searchForm");

const province =
    document.getElementById("province");

const quickDate =
    document.getElementById("quickDate");

const selectedDate =
    document.getElementById("selectedDate");

const nameInput =
    document.getElementById("name");

const searchButton =
    document.getElementById("searchButton");

const emptyState =
    document.getElementById("emptyState");

const loadingState =
    document.getElementById("loadingState");

const errorState =
    document.getElementById("errorState");

const errorMessage =
    document.getElementById("errorMessage");

const results =
    document.getElementById("results");

const resultCount =
    document.getElementById("resultCount");


/* =========================================================
   TARİH FORMATLAMA
========================================================= */

function formatDate(date) {

    const year =
        date.getFullYear();

    const month =
        String(date.getMonth() + 1).padStart(2, "0");

    const day =
        String(date.getDate()).padStart(2, "0");

    return `${year}-${month}-${day}`;

}


/* =========================================================
   BUGÜNÜ SEÇ
========================================================= */

function setToday() {

    const today = new Date();

    selectedDate.value =
        formatDate(today);

}


/* =========================================================
   TARİHİ GERİ AL
========================================================= */

function getPastDate(days) {

    const date = new Date();

    date.setDate(
        date.getDate() - days
    );

    return formatDate(date);

}


/* =========================================================
   HIZLI TARİH
========================================================= */

function applyQuickDate(period) {

    document
        .querySelectorAll(".quick-button")
        .forEach(function(button) {

            button.classList.remove("active");

        });


    const matchingButton =
        document.querySelector(
            `.quick-button[data-period="${period}"]`
        );


    if (matchingButton) {

        matchingButton.classList.add("active");

    }


    if (period === "today") {

        selectedDate.value =
            getPastDate(0);

    }


    if (period === "yesterday") {

        selectedDate.value =
            getPastDate(1);

    }


    if (period === "beforeYesterday") {

        selectedDate.value =
            getPastDate(2);

    }


    if (period === "last3") {

        selectedDate.value =
            getPastDate(0);

    }


    if (period === "last7") {

        selectedDate.value =
            getPastDate(0);

    }

}


/* =========================================================
   SELECT DEĞİŞİNCE
========================================================= */

quickDate.addEventListener(
    "change",
    function() {

        if (this.value) {

            applyQuickDate(
                this.value
            );

        }

    }
);


/* =========================================================
   HIZLI BUTONLAR
========================================================= */

document
    .querySelectorAll(".quick-button")
    .forEach(function(button) {

        button.addEventListener(
            "click",
            function() {

                const period =
                    this.dataset.period;

                quickDate.value =
                    period;

                applyQuickDate(
                    period
                );

            }
        );

    });


/* =========================================================
   TAKVİM SEÇİLİRSE HIZLI TARİHİ TEMİZLE
========================================================= */

selectedDate.addEventListener(
    "change",
    function() {

        quickDate.value = "";

        document
            .querySelectorAll(".quick-button")
            .forEach(function(button) {

                button.classList.remove("active");

            });

    }
);


/* =========================================================
   ARAMA
========================================================= */

searchForm.addEventListener(
    "submit",
    async function(event) {

        event.preventDefault();


        const selectedProvince =
            province.value;

        const date =
            selectedDate.value;

        const personName =
            nameInput.value.trim();


        /*
         * Tarih zorunlu.
         */

        if (!date) {

            errorState.style.display =
                "block";

            errorMessage.textContent =
                "Lütfen Bugün, Dün gibi bir hızlı tarih seçin veya takvimden bir tarih belirleyin.";

            return;

        }


        /*
         * Temizle
         */

        emptyState.style.display =
            "none";

        errorState.style.display =
            "none";

        results.innerHTML = "";

        resultCount.style.display =
            "none";


        /*
         * Yükleniyor
         */

        loadingState.style.display =
            "block";

        searchButton.disabled =
            true;

        searchButton.textContent =
            "ARAMA YAPILIYOR...";


        try {


            /*
             * Şimdilik yalnızca Gaziantep
             * gerçek veri kaynağına bağlanıyor.
             */

            if (
                selectedProvince ===
                "gaziantep"
            ) {


                const params =
                    new URLSearchParams();


                params.set(
                    "date",
                    date
                );


                if (personName) {

                    params.set(
                        "name",
                        personName
                    );

                }


                const response =
                    await fetch(
                        "api/gaziantep.php?" +
                        params.toString(),
                        {
                            method: "GET",
                            headers: {
                                "Accept":
                                    "application/json"
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        "Veri kaynağına ulaşılamadı."
                    );

                }


                const data =
                    await response.json();


                loadingState.style.display =
                    "none";


                if (!data.success) {

                    throw new Error(
                        data.message ||
                        "Veri alınamadı."
                    );

                }


                showResults(
                    data.records || [],
                    date
                );


            } else {


                /*
                 * Henüz gerçek bağlantısı
                 * kurulmamış iller.
                 */

                loadingState.style.display =
                    "none";


                errorState.style.display =
                    "block";


                errorMessage.textContent =
                    "Bu il için henüz doğrulanmış ve teknik olarak erişilebilen bir kamu veri kaynağı sisteme bağlanmadı. Bu nedenle tahmini veya sahte kayıt gösterilmiyor.";

            }


        } catch (error) {

            loadingState.style.display =
                "none";


            errorState.style.display =
                "block";


            errorMessage.textContent =
                error.message ||
                "Veri kaynağına ulaşılamadı.";

        }


        searchButton.disabled =
            false;

        searchButton.textContent =
            "VEFAT EDENLERİ GÖSTER";

    }
);


/* =========================================================
   SONUÇLARI GÖSTER
========================================================= */

function showResults(
    records,
    searchDate
) {

    results.innerHTML = "";

    resultCount.style.display =
        "inline-block";

    resultCount.textContent =
        records.length +
        " kayıt";


    if (!records.length) {

        results.innerHTML = `

            <div class="empty-state">

                <div class="empty-symbol">
                    🔎
                </div>

                <h3>
                    Kayıt bulunamadı
                </h3>

                <p>
                    Seçtiğiniz tarih ve arama ölçütleri için
                    erişilebilen kamuya açık bir kayıt bulunamadı.
                    Bu durum kişinin vefat etmediği anlamına gelmez.
                </p>

            </div>

        `;

        return;

    }


    records.forEach(
        function(record) {


            const card =
                document.createElement(
                    "article"
                );


            card.className =
                "result-card";


            card.innerHTML = `

                <div class="result-top">

                    <div>

                        <h3 class="result-name">
                            ${escapeHtml(
                                record.name ||
                                "Bilgi yok"
                            )}
                        </h3>

                        <div class="result-location">

                            ${escapeHtml(
                                record.province ||
                                ""
                            )}

                            ${
                                record.district
                                ?
                                " / " +
                                escapeHtml(
                                    record.district
                                )
                                :
                                ""
                            }

                        </div>

                    </div>


                    <div class="source-badge">

                        ${escapeHtml(
                            record.source ||
                            "Kamu kaynağı"
                        )}

                    </div>

                </div>


                <div class="result-details">


                    <div class="detail">

                        <span class="detail-label">
                            Vefat Tarihi
                        </span>

                        <span class="detail-value">
                            ${escapeHtml(
                                record.deathDate ||
                                "Belirtilmemiş"
                            )}
                        </span>

                    </div>


                    <div class="detail">

                        <span class="detail-label">
                            Yaş
                        </span>

                        <span class="detail-value">
                            ${escapeHtml(
                                record.age ||
                                "Belirtilmemiş"
                            )}
                        </span>

                    </div>


                    <div class="detail">

                        <span class="detail-label">
                            Defin Yeri
                        </span>

                        <span class="detail-value">
                            ${escapeHtml(
                                record.burialPlace ||
                                "Belirtilmemiş"
                            )}
                        </span>

                    </div>


                    <div class="detail">

                        <span class="detail-label">
                            Doğum Yılı
                        </span>

                        <span class="detail-value">
                            ${escapeHtml(
                                record.birthYear ||
                                "Belirtilmemiş"
                            )}
                        </span>

                    </div>


                </div>


                ${
                    record.sourceUrl
                    ?
                    `
                    <a
                        class="source-link"
                        href="${escapeAttribute(
                            record.sourceUrl
                        )}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Resmî kaynak kaydını görüntüle →
                    </a>
                    `
                    :
                    ""
                }

            `;


            results.appendChild(
                card
            );

        }
    );

}


/* =========================================================
   GÜVENLİ HTML
========================================================= */

function escapeHtml(value) {

    return String(value)
        .replace(
            /&/g,
            "&amp;"
        )
        .replace(
            /</g,
            "&lt;"
        )
        .replace(
            />/g,
            "&gt;"
        )
        .replace(
            /"/g,
            "&quot;"
        )
        .replace(
            /'/g,
            "&#039;"
        );

}


function escapeAttribute(value) {

    return escapeHtml(
        value
    );

}


/* =========================================================
   SAYFA AÇILDIĞINDA TARİH
========================================================= */

setToday();

</script>

</body>
</html>
