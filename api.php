<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/candidate.php";
$client=new MongoDB\Client;
//meter un if que haga ping else se sale con mensaje no se pudo conectar a la bd mongodb false


$arr=[];
$arr['mongodb']=true;



if($_SERVER['REQUEST_METHOD']==='POST'){
$x='';

$x=$_POST['action'];
/***********************Test***********************/
if ($x == 'TEST'){
$arr['msg']='Api Works';
echo json_encode($arr);
}

/**********************Candidatos******************************************/


/****************Insert Candidates******************/
if ($x == 'ADD'){
$collection = (new MongoDB\Client)->test->candidate;
//verificar que no exist6a primero?
$result = $collection->insertOne(['name'=>$_POST['nombre'],'lastname'=>$_POST['apellido']]);
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
    ['$set' => ['name' => $_POST['nombre'],'lastname'=>$_POST['apellido']]]
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

/*************Job*Positions***********************************/

/****************Insert Jobs******************/
if ($x == 'ADDPOS'){
$collection = (new MongoDB\Client)->test->jobs;
//verificar que no exist6a primero?
$result = $collection->insertOne(['name'=>$_POST['nombre'],'description'=>$_POST['descripcion']]);
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']='Puesto insertado correctamente';
//var_dump($person);
echo json_encode($arr);
}
/****************Update Jobs by ID******************/
if ($x == 'UPDPOS'){
$collection = (new MongoDB\Client)->test->jobs;
//verificar que no exist6a primero?
$result = $collection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id'])],
    ['$set' => ['name' => $_POST['nombre'],'description'=>$_POST['descripcion']]]
);
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']=$result->getMatchedCount().' Puesto actualizado';
//var_dump($person);
echo json_encode($arr);
}
/****************Delete Jobs by ID******************/
if ($x == 'DELPOS'){
$collection = (new MongoDB\Client)->test->jobs;
//verificar que no exist6a primero?
$result = $collection->deleteOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id']) ]
);
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']=$result->getDeletedCount().' Puesto Eliminado';
//var_dump($person);
echo json_encode($arr);
}

/****************Read Jobs******************/
if ($x == 'LEEPOS'){
$collection = (new MongoDB\Client)->test->jobs;
$result = $collection->find();
$arr['msg']='Puesto Obtenidos';
foreach ($result as $document) {
	$data[]=$document;
}
$arr['response']=$data;
echo json_encode($arr);
}

if ($x == 'LEEUNOPOS'){
$collection = (new MongoDB\Client)->test->jobs;
$result = $collection->findOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id']) ]
);
$arr['msg']='Puesto Obtenido';
$arr['response']=$result;
echo json_encode($arr);
}

/************************RESUMES**********************************************/

//INSERTA
//db.resume.insertOne({"candidate" : { "$ref" : "candidate", "$id" : "5974640eebb5923358004d68" }, "experience" : "no" })
if ($x == 'ADDRES'){
$collection = (new MongoDB\Client)->test->resume;
//verificar que no exist6a primero?
$result = $collection->insertOne([
	'candidate'=>$_POST['candidateid'],
	'experience'=>$_POST['experiencia']]);
//$person = $collection->findOne(['_id' => $result->getInsertedId()]);
$arr['msg']='Resume insertado correctamente';
//var_dump($person);
echo json_encode($arr);
}


if ($x == 'UPDRES'){
$collection = (new MongoDB\Client)->test->resume;
//verificar que no exist6a primero?
$result = $collection->updateOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id'])],
    ['$set' => [
    	'candidate'=>$_POST['candidateid'],
		'experience'=>$_POST['experiencia']
    ]]
);
$arr['msg']=$result->getMatchedCount().' Resume actualizado';
//var_dump($person);
echo json_encode($arr);
}

if ($x == 'DELRES'){
$collection = (new MongoDB\Client)->test->resume;
$result = $collection->deleteOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id']) ]
);
$arr['msg']=$result->getDeletedCount().' Resume Eliminado';
echo json_encode($arr);
}



//LEE:
//db.resume.aggregate([{$lookup:{from:'candidate', localField:'candidate.id', foreignField: 'id', as: 'candidate'}}])
if ($x == 'LEERES'){
$collection = (new MongoDB\Client)->test->resume;
//$result = $collection->find();
$result = $collection->aggregate([
		['$lookup'=>
			[
				'from' => 'candidate',
				'localField' => 'candidate.id',
				'foreignField' => 'id',
				'as' => 'candidate'
			]
		]
	]);
$arr['msg']='Resumes Obtenidos';
foreach ($result as $document) {
	$data[]=$document;
}
$arr['response']=$data;
echo json_encode($arr);
}

if ($x == 'LEEUNORES'){
$collection = (new MongoDB\Client)->test->resume;
$result = $collection->findOne(
    ['_id' => new MongoDB\BSON\ObjectID($_POST['id']) ]
);
$arr['msg']='Resume Obtenido';
$arr['response']=$result;
echo json_encode($arr);
}

}

?>