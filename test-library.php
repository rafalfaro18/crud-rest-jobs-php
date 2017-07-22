<?php
//require_once __DIR__ . "/vendor/autoload.php";

//$client=new MongoDB\Client;

//$database = $client ->test;

//$cursor = $database->command(['ping' => 1]);

/*var_dump($cursor->toArray()[0]);

echo "<br><br>";*/

/*var_dump($database); 

echo "<br><br>";
foreach ((new MongoDB\Client)->listDatabases() as $databaseInfo) {
    var_dump($databaseInfo);
    //echo $databaseInfo["name"]."<br>";
    
}*/

/*$collection = $client->test->beers;

$result = $collection->insertOne( [ 'name' => 'Hinterland', 'brewery' => 'BrewDog' ] );

echo "Inserted with Object ID '{$result->getInsertedId()}'";*/

/*$collection = (new MongoDB\Client)->test->candidate;
$result = $collection->find();
$arr['msg']='Candidatos Leidos';
foreach ($result as $document) {
   $data[]= $document;
}
$arr['response'] = $data;
echo json_encode($arr);*/

/*$collection = (new MongoDB\Client)->test->candidate;
$result = $collection->find(array(),array('_id'=>0));
$arr['msg']='Candidatos Leidos';
foreach ($result as $document) {
   $data[]= $document;
}

var_dump(json_encode($data));*/

$postdata = file_get_contents("php://input");
$obj = $postdata;
var_dump($obj);

echo "<br><br>";

var_dump($_POST);


?>