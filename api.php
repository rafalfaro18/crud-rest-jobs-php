<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/candidate.php";
$client=new MongoDB\Client;
//meter un if que haga ping else se sale con mensaje no se pudo conectar a la bd mongodb false
$collection = $client->test->beers;

$arr=[];
$arr['mongodb']=true;

if($_SERVER['REQUEST_METHOD']==='POST'){//Acceso a la API

/****************Insert Candidates******************/

$collection = (new MongoDB\Client)->test->candidate;
$result = $collection->insertOne(new Candidate($_POST['nombre']));
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']='Candidato insertado correctamente';
//var_dump($person);
echo json_encode($arr);
/***************************************/

}
?>