GÜNDEM HABER SİSTEMİ

Dosyalar:
- gundem.html       Ziyaretçi sayfası
- haber-detay.html  Haber detay sayfası
- gundem-admin.html Yönetim paneli
- firebase-config.js Firebase proje bilgileri
- firestore.rules  Veritabanı güvenlik kuralları
- storage.rules    Fotoğraf güvenlik kuralları

KURULUM:
1. Firebase projesi oluşturun.
2. Authentication > Sign-in method > Email/Password etkinleştirin.
3. Authentication > Users bölümünde yalnızca sizin kullanacağınız admin hesabını oluşturun.
4. Firestore Database'i etkinleştirin.
5. Storage'ı etkinleştirin.
6. Firebase proje ayarlarından Web App oluşturup firebase-config.js içindeki değerleri doldurun.
7. Authentication Users içindeki admin UID'sini firestore.rules ve storage.rules dosyalarındaki ADMIN_UID yerine yazın.
8. Kuralları Firebase'e yayınlayın.
9. Bu dosyaları GitHub Pages sitenize yükleyin.
10. gundem-admin.html adresine yalnızca admin hesabınızla girin.

SİSTEM:
Admin panelinden eklenen yayınlar Firestore'a kaydedilir.
Fotoğraflar Firebase Storage'a gider.
gundem.html yalnızca published=true olan haberleri gösterir.
Ziyaretçiler veri yazamaz, haber ekleyemez, silemez veya düzenleyemez.
Yorum sistemi yoktur.
Harici haber/RSS/API kullanılmaz.
