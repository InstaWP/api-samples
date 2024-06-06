<?php

// Function to execute a command on InstaWP site
function executeCommand($apiUrl, $siteId, $commandId, $commandArguments, $apiKey) {
    $url = $apiUrl . "/sites/" . $siteId . "/execute-command";

    $data = [
        "command_id" => $commandId,
        "commandArguments" => $commandArguments
    ];

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer " . $apiKey
        ],
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data)
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    curl_close($ch);

    return $response;
}

$apiKey = "<api>"; // Replace with your actual API key
$siteId = 987567; // Replace with your actual site ID
$apiUrl = "https://app.instawp.io/api/v2"; 


// Example: Create a WP admin user.
$commandId = 1130; // Replace with your actual command ID
$commandArguments = [];

$response = executeCommand($apiUrl, $siteId, $commandId, $commandArguments, $apiKey);
echo $response;

// Example: List WP users

$commandId = 1131; // Replace with your actual command ID
$commandArguments = [];


$response = executeCommand($apiUrl, $siteId, $commandId, $commandArguments, $apiKey);
echo $response;
