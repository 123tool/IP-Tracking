# 🛡️ Ip Tracking (Security)

Logger informasi sistem yang terintegrasi dengan PHP-Backend untuk pengiriman data real-time ke Telegram Bot. Dilengkapi dengan antarmuka "Link-in-Bio" modern untuk meminimalisir kecurigaan pengguna.

## 🚀 Keunggulan
- **Stealth Integration:** Data dikirim menggunakan metode `fetch` asinkron tanpa interupsi UI.
- **Visual Camouflage:** Menggunakan tema profil digital profesional dengan logo Google Analytics palsu di footer.
- **Backend Isolation:** Token API Telegram tidak pernah terekspos ke sisi klien (browser).
- **Environment Context:** Mendeteksi resolusi layar, bahasa sistem, zona waktu, dan HTTP Referrer.

## 🛠️ Prasyarat
- Server Web (Apache/Nginx) dengan dukungan **PHP 7.4+**.
- Akun Telegram dan Bot
- Chat ID Anda

## ⚙️ Cara Setup
1. Upload `index.html` dan `send.php` ke hosting Anda.
2. Edit `send.php`, isi `$BOT_TOKEN` dan `$CHAT_ID`.
3. Selesai. Setiap kunjungan akan menghasilkan laporan detail di Telegram Anda.

## ⚖️ Etika & Hukum
Alat ini disediakan hanya untuk tujuan **analisis keamanan dan edukasi**. Pengguna bertanggung jawab penuh atas segala tindakan yang dilakukan dengan alat ini.
