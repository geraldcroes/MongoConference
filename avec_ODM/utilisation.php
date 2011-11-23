<?php
include __DIR__.'/./bootstrap.php';

use PHPTour\Conferencier,
    PHPTour\Conference,
    PHPTour\Slides,
    PHPTour\ElementDePlan;

//Nouveau conférencier
$conferencier = new Conferencier();
$conferencier->setNom('Croes')
             ->setPrenom('Gerald')
             ->setEntreprise('Alptis');

//Nouvelle conférence
$conference = new Conference();
$conference  ->setTitre('hello $Mongo;')
             ->addConferencier($conferencier)
             ->setLieu('Salle de conférence 1')
             ->setDate(new DateTime('2011-11-24 10:15:00'));

//Fichiers slides
$slides = new Slides();
$slides->setFichier(__DIR__.'/datatest/helloMongo.pdf');
$conference->setSlides($slides);

//Ajout d'un plan de présentation
$elementDePlan1 = new ElementDePlan();
$elementDePlan1->setTitre('Introduction')
                ->addSlides(1)
                ->addSlides(2)
                ->addSlides(3)
                ->addSlides(4);

$elementDePlan2 = new ElementDePlan();
$elementDePlan2->setTitre('La persistance')
                ->addSlides(5)
                ->addSlides(6)
                ->addSlides(7);

$conference->addElementDePlan($elementDePlan1)
            ->addElementDePlan($elementDePlan2);

//Demande de persistance de toutes les données
$dm->persist($slides);
$dm->persist($conferencier);
$dm->persist($conference);
$dm->flush();

//Lecture des conférences de la base
foreach ($dm->createQueryBuilder('PHPTour\Conference')
        ->sort('titre', 'asc')
        ->getQuery()
        ->execute() as $element){
    echo $element->getTitre();
}