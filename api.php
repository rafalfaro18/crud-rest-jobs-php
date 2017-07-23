<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/candidate.php";
$client=new MongoDB\Client;
//meter un if que haga ping else se sale con mensaje no se pudo conectar a la bd mongodb false
$collection = $client->test->candidate;

$arr=[];
$arr['mongodb']=true;



//if($_SERVER['REQUEST_METHOD']==='POST'){//Acceso a la API
$x='';

//if ($json_input) {
 //   $_REQUEST = json_decode($json_input, true);
 //   $x=$_REQUEST['action'];
//}else{
$x=$_POST['action'];

//}

/***********************Test***********************/
if ($x == 'TEST'){
$arr['msg']='Api Works';
echo json_encode($arr);
}
/****************Insert Candidates******************/
if ($x == 'ADD'){
$collection = (new MongoDB\Client)->test->candidate;
//verificar que no exist6a primero?
$result = $collection->insertOne(['name'=>$_POST['nombre']]);
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']='Candidato insertado correctamente';
//var_dump($person);
echo json_encode($arr);
}
/****************Update Candidates by ID******************/
if ($x == 'UPD'){
$collection = (new MongoDB\Client)->test->candidate;
//verificar que no exist6a primero?
$result = $collection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id'])],
    ['$set' => ['name' => $_POST['nombre']]]
);
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']=$result->getMatchedCount().' Candidato actualizado';
//var_dump($person);
echo json_encode($arr);
}
/****************Delete Candidates by ID******************/
if ($x == 'DEL'){
$collection = (new MongoDB\Client)->test->candidate;
//verificar que no exist6a primero?
$result = $collection->deleteOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id']) ]
);
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']=$result->getDeletedCount().' Candidato Eliminado';
//var_dump($person);
echo json_encode($arr);
}

/****************Read Candidates******************/
if ($x == 'LEE'){
$collection = (new MongoDB\Client)->test->candidate;
$result = $collection->find();
$arr['msg']='Candidatos Obtenidos';
foreach ($result as $document) {
	$data[]=$document;
}
$arr['response']=$data;
echo json_encode($arr);
}

if ($x == 'LEEUNO'){
$collection = (new MongoDB\Client)->test->candidate;
$result = $collection->findOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id']) ]
);
$arr['msg']='Candidato Obtenido';
$arr['response']=$result;
echo json_encode($arr);
}

//recorrer las filas de la tabla como $row, $data[]=$row.
//Select $arr['response'] = $data
//}
//recorrer las filas de la tabla como $row, $data[]=$row.
//Select $arr['response'] = $data
//}

?>