<?php
require_once __DIR__ . "/vendor/autoload.php";

$client=new MongoDB\Client;

$database = $client ->test;

$cursor = $database->command(['ping' => 1]);

var_dump($cursor->toArray()[0]);

?>