<?php
// Your IPinfo Access Token
$accessToken = "2e8d2e0b7e4d36";

// Get the visitor's IP address
$ip = $_SERVER['REMOTE_ADDR'];

// Query IPinfo API
$apiUrl = "https://ipinfo.io/{$ip}/json?token=2e8d2e0b7e4d36";
$response = @file_get_contents($apiUrl);
$data = json_decode($response, true);

// Optional: Block known bots if bot detection is enabled
if (isset($data['bot']) && $data['bot']['is_bot'] === true) {
    // You can log bot access or simply stop here
    exit("Access blocked for bots.");
}

// Get country code
$countryCode = $data['country'] ?? '';

// Redirect based on country
if ($countryCode === 'US' || $countryCode === 'CA') {
    // Redirect USA/Canada visitors to Page A
    header("Location: https://facebook.com/");
} else {
    // Redirect others to Page B
    header("Location: https://google.com/");
}

exit();
?>
