<?php

$ct = new Mongo();
$conferenciers = $ct->phptour->conferenciers;
$evenements = $ct->phptour->evenements;

$plan = array(
            array('titre'=>'Introduction', 'slides'=>array(1,2,3,4)),
            array('titre'=>'Persistance des données', 'slides'=>array(5,6,7)),
            array('titre'=>'Premier document', 'slides'=>array(8,9))
              );
$conferenceMongo = $evenements->findOne(array('titre'=>'hello $Mongo;'));
$conferenceMongo['plan'] = $plan;

$evenements->save($conferenceMongo);