<?php
$client = new SoapClient(null, [
    'location' => 'http://localhost/PHP_training/Day1/PHP_Simple_Exampl_API/soap_api.php',
    'uri' => 'http://localhost',
    'trace' => 1
]);

$response = $client->getUser(1);
echo "<pre>";
print_r($response);
