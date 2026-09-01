(function() {
  window.addEventListener('load', function() {
    setTimeout(async function() {
      // Botları engelle
      if (navigator.userAgent.match(/bot|crawl|spider|slurp|facebook/i)) return;
      
      // Aynı oturumda tekrarlayan mailleri engelle
      if (sessionStorage.getItem('visited')) return;
      sessionStorage.setItem('visited', 'true');

      try {
        // HTTPS destekli güvenli IP ve konum servisi
        const ipRes = await fetch('https://ipapi.co/json/');
        const ipData = await ipRes.json();

        // Cihaz tespiti
        const ua = navigator.userAgent;
        let device = "Masaüstü (PC)";
        if (/Mobi|Android|iPhone|iPad/i.test(ua)) {
          device = /iPad|Tablet/i.test(ua) ? "Tablet" : "Mobil (" + (navigator.platform || "Telefon") + ")";
        }

        const visitorData = {
          sayfa: window.location.pathname || '/',
          sehir: ipData.city || 'Bilinmiyor',
          ulke: ipData.country_name || ipData.country || 'Bilinmiyor',
          ip: ipData.ip || 'Bilinmiyor',
          cihaz: device,
          tarih: new Date().toLocaleString('tr-TR')
        };

        // Formspree bildirimi
        fetch('https://formspree.io/f/xjyvwbjy', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(visitorData)
        });
      } catch (e) {}
    }, 2000);
  });
})();
