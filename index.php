<?php
// Your IPinfo Access Token
$accessToken = "2e8d2e0b7e4d36";

// Get the visitor's IP address
$ip = $_SERVER['REMOTE_ADDR'];

// Query IPinfo API
$apiUrl = "https://ipinfo.io/{$ip}/json?token={$accessToken}";
$response = @file_get_contents($apiUrl);
$data = json_decode($response, true);


// Get country code
$countryCode = $data['country'] ?? '';

// Redirect based on country
if ($countryCode === 'US' || $countryCode === 'CA') {
    // Redirect USA/Canada visitors to Page A
    header("Location: https://facebook.com");
} else {
    // Redirect others to Page B
    header("Location: https://google.com/");
}

exit();
?>
