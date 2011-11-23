<?php
$ct = new Mongo();
$evenements = $ct->phptour->evenements;

$evenements->update(array('tags'=>array('$in'=>array('Optimisation,XDebug'))),
                    array('$pushAll'=>array('tags'=>array('Optimisation', 'XDebug'))));

$evenements->update(array('tags'=>array('$in'=>array('Optimisation,XDebug'))),
                    array('$pull'=>array('tags'=>'Optimisation,XDebug')));

$evenements->update(array('tags'=>array('$in'=>array(""))),
                    array('$pull'=>array('tags'=>"")));