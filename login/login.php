<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php'; // Include the Google API PHP Client Library

// Create a new Google client
$client = new Google_Client();
$client->setClientId('');
$client->setClientSecret('');
$client->setRedirectUri('');
$client->addScope('email');

// Create a new MySQL connection


// Handle the Google callback
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    
    // Store user information in MySQL database
    $email = $google_account_info->email;
    $name = $google_account_info->name;
 // echo   $query = "INSERT INTO users (email, name) VALUES ('$email', '$name')";
   
    echo "You are logined sussessfully ".$email;
    // Redirect or do something else after successful login
   
    exit();
}

// Generate the Google login URL
$authUrl = $client->createAuthUrl();
?>

<!-- Display the login button -->
<center><a href="<?php echo $authUrl; ?>">Login with Google</a></center>
