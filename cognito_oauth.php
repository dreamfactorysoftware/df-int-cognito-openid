<?php

    // script located here -> /var/www/cognito_oauth.php
    if( $_GET["code"] ) {
        echo "Your code is: " . $_GET['code'] . "<br />";
    }

    $url = "{YOUR_COGNITO_URL}/oauth2/token";
    // $redirect_url should be he same as Redirect URL from Config tab on DreamFactory
    $redirect_url = '{Your application endpoint}';
    $client_key = "{Client ID}";
    $client_secret = "{Client Secret}";
    $data = [
        'grant_type' => 'authorization_code',
        'client_id'=>$client_key,
        'code'=>$_GET['code'],
        'redirect_uri'=>$redirect_url
    ];
    $field_string = http_build_query($data);

    if($_GET["code"]) {

        $handle = curl_init($url);
        curl_setopt($handle, CURLOPT_VERBOSE, true);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_USERPWD, $client_key . ":" . $client_secret);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $field_string);
        $resp = json_decode(curl_exec($handle),true);
        print('<pre>');
        print_r($resp);
        print('<pre>');

        curl_close($handle);
    }

?>