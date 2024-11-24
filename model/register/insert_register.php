<?php

// **Important Security Note:**
// - **NEVER** hardcode your reCAPTCHA secret key in your code.
// - Store the secret key securely in an environment variable or a configuration file outside your web root.
// - Access the secret key using the appropriate method based on your server environment (e.g., `getenv()` for environment variables).

// Replace with the actual value from your Google reCAPTCHA settings
$recaptcha_secret = '6LfC_4gqAAAAANVt8ZaII_KyOwXdJrynx4iFQIej';

// Validate if the reCAPTCHA response is present in the POST data
if (!isset($_POST['recaptcha_response'])) {
    echo 'Error: Missing reCAPTCHA response.';
    exit;
}

$recaptcha_response = $_POST['recaptcha_response'];

// Build the reCAPTCHA verification URL with parameters
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => $recaptcha_secret,
    'response' => $recaptcha_response,
    'remoteip' => $_SERVER['REMOTE_ADDR']
 // Include user's IP address for security
);

// Use cURL (more secure and flexible than file_get_contents)
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $recaptcha_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); 
$response = curl_exec($ch);
curl_close($ch);

// Decode the JSON response from Google
$recaptcha = json_decode($response);

if (isset($recaptcha->success) && $recaptcha->success) {
    // Score-based validation (optional)
    if ($recaptcha->score >= 0.7) {
        echo 'Valid reCAPTCHA response (score: ' . $recaptcha->score . ').';
        // Proceed with form processing or other actions
    } else {
        echo 'Low reCAPTCHA score (' . $recaptcha->score . '). User may be a bot.';
        // Handle low score (e.g., display additional verification)
    }
} else {
    echo 'Invalid reCAPTCHA response.';
    // Handle invalid response (e.g., display error message)
}

?>