<?php

$ct = new Mongo();
$evenements = $ct->phptour->evenements;


$evenements->update(
   array('titre'=>'hello $Mongo;'),
   array('titre'=>'hello $Mongo;',
         'lieu'=>'Salle de conférence 1',
         'date'=>new MongoDate(strtotime('2011-11-24 10:15:00')))
);

$helloMongo = $evenements->findOne(array('titre'=>'hello $Mongo;'));


$evenements->update(
    array('titre'=>'hello $Mongo;'),
    array('$set'=>array('date'=>new MongoDate(strtotime('2011-11-24 10:15:30'))))
);

$helloMongo = $evenements->findOne(array('titre'=>'hello $Mongo;'));
echo "\n", date('Y-m-d H:i:s', $helloMongo['date']->sec);