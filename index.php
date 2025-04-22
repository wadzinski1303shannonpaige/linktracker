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

// Simple geo lookup using ip-api (you can replace this with a more robust API)
function getCountryCode($ip) {
    $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=countryCode");
    if ($response) {
        $data = json_decode($response, true);
        return $data['countryCode'] ?? 'UNKNOWN';
    }
    return 'UNKNOWN';
}

// Start checking
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';

// Redirect bots to Weebly
if (isBot($userAgent)) {
    header("Location: https://www.weebly.com");
    exit;
}

// Geo-location logic
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
