<?php
echo "Lancement";
//connection à la base de données
$ct = new Mongo();

$ct->phptour->drop();

//Sélection de la base mongoconference
$db = $ct->phptour;

//Sélection de la collection conferences
$evenements = $db->evenements;

$conferenceMongo = array('titre' => 'hello $Mongo;',
                         'lieu' => 'Salle de conférence 1');
$evenements->insert($conferenceMongo);

//Sélection du contenu de la base
foreach ($evenements->find() as $document) {
    echo "{$document['titre']} ({$document['_id']})\n\r";
}

echo "Fin";