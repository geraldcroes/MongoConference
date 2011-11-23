<?php
$ct = new Mongo();
$evenements = $ct->phptour->evenements;


$keynote = array('titre' => "Keynote d'ouverture",
                         'lieu' => 'Auditorium',
                         'date'=>new MongoDate(strtotime('2011-11-24 9:00:00')),
                         'type'=>'Keynote',
                         'minutes'=>30);

$repas = array('titre' => "Repas",
                         'date'=>new MongoDate(strtotime('2011-11-24 12:45:00')),
                         'type'=>'Pause',
                         'minutes'=>60);

$pauseMatin = array('titre' => "Pause",
                         'date'=>new MongoDate(strtotime('2011-11-24 11:00:00')),
                         'type'=>'Pause',
                         'minutes'=>15);

$pauseAM = array('titre' => "Pause",
                         'date'=>new MongoDate(strtotime('2011-11-24 15:30:00')),
                         'type'=>'Pause',
                         'minutes'=>15);

$evenements->insert($keynote);
$evenements->insert($repas);
$evenements->insert($pauseMatin);
$evenements->insert($pauseAM);