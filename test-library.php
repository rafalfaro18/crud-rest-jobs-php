<?php
require_once __DIR__ . "/vendor/autoload.php";

$database = (new MongoDB\Client)->test;

$cursor = $database->command(['ping' => 1]);

var_dump($cursor->toArray()[0]);
?>