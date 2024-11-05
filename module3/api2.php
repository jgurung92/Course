<?php
    $url = 'http://localhost:3000/api/v1/nepalSupermarket';

    $urlwithparams = $url;
    // initilize the session
    $session = curl_init();
    // set the session options
    curl_setopt($session, CURLOPT_URL, $urlwithparams); //endpoint
    curl_setopt($session, CURLOPT_RETURNTRANSFER, $urlwithparams); //endpoint
    // execute the request
    $response = curl_exec($session);
    // cath errors
    if ($response === false) {
        echo 'Error' . curl_error($session);

    } else {
        // return JSON
        $responseData = json_decode($response, true);
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    // close session
    curl_close($session);

?>