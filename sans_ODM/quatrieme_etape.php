<?php
$ct = new Mongo();
$evenements = $ct->phptour->evenements;

foreach ($ct->phptour->command(array('distinct'=>'evenements', 'key'=>'type')) as $result){
   print_r($result);
}

foreach ($ct->phptour->command(array('distinct'=>'evenements', 'key'=>'minutes', 'query'=>array('type' => 'Pause'))) as $result){
    print_r($result);
}

echo $evenements->find(array('type'=>'Pause'))->count();

echo "\nDistinct";
foreach ($evenements->group(
                            array('minutes'=>1),
                            array('nb'=>0),
                            'function (obj, prev) { prev.nb += 1; }',
                            array('type'=>'Pause')

                            ) as $result) {
    print_r($result);
}

$evenements->update(array('type'=>array('$exists'=>false)), array('$set'=>array('type'=>'Conference', 'minutes'=>45)));