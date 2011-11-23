<?php


$ct = new Mongo();
$conferenciers = $ct->phptour->conferenciers;

$jmf = array('prenom'=>'Jean Marc', 'nom'=>'Fontaine', 'entreprise'=>'Alter-Way');

$dsp = array('prenom'=>'David', 'nom'=>'Soria Parra', 'presentation'=>"David Soria Parra is a software engineer at Open Source Labs of Mayflower GmbH in Germany and student at the Karlsruhe Institute of Technology. He is a contributor to PHP and one of the release managers of PHP 5.4. Over the past two years, the community has worked on the next major release of PHP. With the first beta versions already released, PHP 5.4 is right at our doorsteps. How did PHP evolve over the last two years? What will change with PHP 5.4? We will take a look at recent changes in the PHP community, introduce the new features of PHP 5.4 and take a look beyond PHP 5.4. PHP is more than a language - it's a vivid open source project.");

$sb = array('prenom'=>'Sophie', 'nom'=>'Beaupuis', 'entreprise'=>'Conforama / la maison de valérie', 'presentation'=>"Ancienne développeuse indépendante je prend en charge la conception, la gestion des équipes de développement, la mise en production et la vie quotidienne d'un site marchand a vocation européenne : conforama.fr / lamaisondevalerie.fr");

$cd = array('prenom'=>'Cedric', 'nom'=>'Derue', 'entreprise'=>'Alptis');
$gc = array('prenom'=>'Gerald', 'nom'=>'Croes', 'entreprise'=>'Alptis');
$conferenciers->save($cd);
$conferenciers->save($gc);

$conferenceMongo = $ct->phptour->evenements->findOne(array('titre'=>'hello $Mongo;'));
$conferenceMongo['conferenciers'] = array ($ct->phptour->conferenciers->createDBRef($cd),
                                            $ct->phptour->conferenciers->createDBRef($gc)
                                            );


$ct->phptour->evenements->save($conferenceMongo);


foreach ($ct->phptour->evenements->find(array('conferenciers'=>array('$size'=>2))) as $conference)
{
   echo $conference['titre'];
}


print_r($ct->phptour->evenements->findOne(array('conferenciers'=>array('$in'=>array($ct->phptour->conferenciers->createDBRef($cd))))));