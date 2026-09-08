# Şahin UYMAZ Haber Sitesi — Kullanım

## Dosyalar
- `index.php` → Ziyaretçilerin gördüğü ana sayfa (gündem)
- `admin.php` → Haber ekleme / düzenleme / silme paneli
- `haber.php` → Tekil haber detay sayfası
- `config.php` → Ayarlar (şifre burada)
- `data/news.json` → Haberlerin kaydedildiği dosya
- `uploads/` → Yüklenen resimler

## Admin Giriş
1. Tarayıcıda `admin.php` adresine gidin.
2. Şifre: **sahin2026**
3. Şifreyi değiştirmek için `config.php` dosyasındaki `ADMIN_PASSWORD` değerini değiştirin.

## Haber Ekleme
1. Admin paneline girin.
2. Başlık, kategori, özet, haber metni yazın.
3. İsterseniz resim yükleyin.
4. “Gündem slider'da göster” kutusunu işaretlerseniz haber ana sayfadaki büyük slider’da çıkar.
5. **Kaydet** butonuna basın.
6. Ana sayfayı yenileyin → haberiniz görünür.

## Hosting
PHP destekleyen herhangi bir hosting’e tüm klasörü yükleyin.
`data/` ve `uploads/` klasörlerinin yazılabilir olması gerekir (izin 755 veya 775).

Dış site / API entegrasyonu yoktur. Tüm haberler sadece sizin eklediğiniz içeriktir.
