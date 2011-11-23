<?php

namespace Hydrators;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\UnitOfWork;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class PHPTourElementDePlanHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data)
    {
        $hydratedData = array();

        /** @Field(type="string") */
        if (isset($data['titre'])) {
            $value = $data['titre'];
            $return = (string) $value;
            $this->class->reflFields['titre']->setValue($document, $return);
            $hydratedData['titre'] = $return;
        }

        /** @Field(type="collection") */
        if (isset($data['slides'])) {
            $value = $data['slides'];
            $return = $value;
            $this->class->reflFields['slides']->setValue($document, $return);
            $hydratedData['slides'] = $return;
        }
        return $hydratedData;
    }
}