<?php
require '../vendor/autoload.php';

use OpenIban\Client;

$client = new Client();
echo '<pre>';
echo "\$client = new Client();" . PHP_EOL;
echo "\$client->validate() => " . PHP_EOL;
var_dump($client->validate('DE89370400440532013000'));
echo PHP_EOL;

echo "\$client->validate(true) => " . PHP_EOL;
var_dump($client->validate('DE89370400440532013000', true));
echo PHP_EOL;

echo "\$client->validate(true, true) => " . PHP_EOL;
var_dump($client->validate('DE89370400440532013000', true, true));
echo '</pre>';
