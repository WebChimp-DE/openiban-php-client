<?php
require '../vendor/autoload.php';

use OpenIban\Client;

$client = new Client();
echo '<pre>';
echo "\$client = new Client();" . PHP_EOL;
echo "\$client->calculate('DE', '37040044', '0532013000') => " . PHP_EOL;
var_dump($client->calculate('DE', '37040044', '0532013000'));
echo '</pre>';