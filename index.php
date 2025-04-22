<?php
// Bot detection function
function isBot($userAgent) {
    $bots = [
        'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baiduspider',
        'yandexbot', 'sogou', 'exabot', 'facebot', 'ia_archiver',
        'mj12bot', 'ahrefsbot', 'semrushbot', 'dotbot', 'gigabot'
    ];
    $userAgent = strtolower($userAgent);
    foreach ($bots as $bot) {
        if (strpos($userAgent, $bot) !== false) {
            return true;
        }
    }
    return false;
}

// Geo-location using cURL and ip-api
function getCountryCode($ip) {
    $url = "https://ip-api.com/json/{$ip}?fields=countryCode";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $data = json_decode($response, true);
        return $data['countryCode'] ?? 'UNKNOWN';
    }

    return 'UNKNOWN';
}

// Main logic
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';

// Redirect bots to Weebly
if (isBot($userAgent)) {
    header("Location: https://www.weebly.com");
    exit;
}

// Get visitor's country code
$countryCode = getCountryCode($ipAddress);

// Redirect based on country
if ($countryCode === 'US' || $countryCode === 'CA') {
    header("Location: https://www.jameskelly.com");
    exit;
} else {
    header("Location: https://www.weebly.com");
    exit;
}
?>
