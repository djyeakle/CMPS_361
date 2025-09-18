<?php

    $url = "http://localhost:8008/api/login";

    $urlWithParams = $url;

    $session = curl_init();

    curl_setopt($session, CURLOPT_URL, $urlWithParams);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, $true);

    $response = curl_exec($session);

    if ($response === false) {
        echo "Error " . curl_error($session);
    } else {
        $responseData = json_decode($response, true);
        header("Content-Type: application/json");
        echo json_encode($responseData);
    }

    curl_close($session);

?>