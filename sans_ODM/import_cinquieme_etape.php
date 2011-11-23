<?php
$ct = new Mongo();
$evenements = $ct->phptour->evenements;

$fp = fopen('./conferences.csv', 'r');
while (($element = fgetcsv($fp, 0, ',', "'")) !== false) {
    print_r($element);
    echo "\n";


    $data = array();
    $data['titre'] = $element[0];
    $data['date'] = new MongoDate(strtotime(str_replace('/', '-', $element[1])));
    $data['lieu'] = $element[2];
    if ($tags = explode(';', $element[3])){
        $data['tags'] = $tags;
    }
    $data['type'] = $element[4];
    $data['minutes'] = 45;
    $evenements->insert($data);
}

