<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://dev-whmcs.jagoanhosting.com/includes/api.php');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt(
    $ch,
    CURLOPT_POSTFIELDS,
    http_build_query(
        array(
            'action' => 'GetTLDPricing',
            // See https://developers.whmcs.com/api/authentication
            'username' => 'BGzl4sUDbEW1xE9vU2E6MNQFxvEy6hFL',
            'password' => '9Fn6ZT3c2Qx0fbuaHZZM80Qk65iv5nYs',
            'currencyid' => '1',
            'responsetype' => 'json',
        )
    )
);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
var_dump($response);
curl_close($ch);
