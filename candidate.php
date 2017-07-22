<?php

class Candidate implements MongoDB\BSON\Persistable
{
    private $id;
    private $name;
    //private $createdAt;

    public function __construct($name)
    {
        $this->id = new MongoDB\BSON\ObjectID;
        $this->name = (string) $name;
        //$this->createdAt = new MongoDB\BSON\UTCDateTime;
    }

    function bsonSerialize()
    {
        return [
            '_id' => $this->id,
            'name' => $this->name,
            //'createdAt' => $this->createdAt,
        ];
    }

    function bsonUnserialize(array $data)
    {
        $this->id = $data['_id'];
        $this->name = $data['name'];
        //$this->createdAt = $data['createdAt'];
    }
}

?>