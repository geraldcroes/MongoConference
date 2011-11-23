<?php
namespace PHPTour;

use Doctrine\Common\Collections\ArrayCollection;
use DateTime;


/**
 * @Document
 */
class Conferencier
{
    /**
     * @Id
     */
    private $id;
    /**
     * @String
     */
    private $nom;
    /**
     * @String
     */
    private $prenom;
    /**
     * @String
     */
    private $entreprise;

    public function setEntreprise($entreprise)
    {
        $this->entreprise = $entreprise;
        return $this;
    }

    public function getEntreprise()
    {
        return $this->entreprise;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
}

/**
 * @Document
 * @InheritanceType("SINGLE_COLLECTION")
 * @DiscriminatorField(fieldName="type")
 * @DiscriminatorMap({"PHPTour\Conference"="Conference", "PHPTour\Keynote"="Keynote", "PHPTour\Pause"="Pause"})
 */
abstract class Evenement
{
    /**
     * @Id
     */
    protected $id;
    /**
     * @String
     */
    protected $titre;
    /**
     * @Date
     */
    protected $date;
    /**
     * @Int
     */
    protected $minutes;

    public function __construct ()
    {
        $this->date = new DateTime();
    }

    public function setTitre ($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    public function getTitre ()
    {
        return $this->titre;
    }

    public function setDate (DateTime $date)
    {
        $this->date = $date;
        return $this;
    }

    public function getDate ()
    {
        return $this->date;
    }

    public function setMinutes ($minutes)
    {
        $this->minutes = $minutes;
        return $this;
    }

    public function getMinutes ()
    {
        return $this->minutes;
    }
}

/**
 * @Document
 */
abstract class Presentation extends Evenement
{
    /**
     * @String
     */
    protected $lieu;

    /**
     * @ReferenceMany(targetDocument="PHPTour\Conferencier")
     */
    protected $conferenciers;

    public function __construct ()
    {
        parent::__construct();
        $this->conferenciers = new ArrayCollection();
    }

    public function addConferencier(Conferencier $conferencier)
    {
        if (!$this->conferenciers->contains($conferencier)){
            $this->conferenciers->add($conferencier);
        }
        return $this;
    }

    public function getConferenciers()
    {
        return $this->conferenciers;
    }

    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getLieu()
    {
        return $this->lieu;
    }
}
/**
 * @Document
 */
class Conference extends Presentation
{
    /**
     * @Collection
     */
    private $tags;

    /**
     * @EmbedMany
     */
    protected $plan;

    /**
     * @ReferenceOne(targetDocument="Slides")
     */
    protected $slides;

    public function __construct ()
    {
        parent::__construct();
        $this->plan = new ArrayCollection();
    }

    public function setSlides (Slides $slides)
    {
        $this->slides = $slides;
    }

    public function addElementDePlan (ElementDePlan $elementDePlan)
    {
        if (!$this->plan->contains($elementDePlan)) {
            $this->plan->add($elementDePlan);
        }
        return $this;
    }
}

/**
 * @Document
 */
class Pause extends Evenement
{
}

/**
 * @Document
 */
class Keynote extends Presentation
{
}

/**
 * @EmbeddedDocument
 */
class ElementDePlan
{
    /**
     * @String
     */
    protected $titre;

    /**
     * @Collection
     */
    protected $slides;

    public function addSlides ($slide)
    {
        if (!is_array($this->slides)) {
            $this->slides = array();
        }
        $this->slides[] = $slide;
        return $this;
    }

    public function getSlides ()
    {
        return $this->slides;
    }

    public function getTitre ()
    {
        return $this->titre;
    }

    public function setTitre ($titre)
    {
        $this->titre = $titre;
        return $this;
    }
}

/**
 * @Document
 */
class Slides
{
    /**
     * @Id
     */
    private $_id;
    /**
     * @File
     */
    private $_fichier;
    /**
     * @Field
     */
    private $uploadDate;
    /**
     * @Field
     */
    private $length;
    /**
     * @Field
     */
    private $filename;
    /**
     * @Field
     */
    private $md5;

    public function getId ()
    {
        return $this->_id;
    }

    public function getFichier ()
    {
        return $this->_fichier;
    }

    public function setFichier ($fichier)
    {
        $this->_fichier = $fichier;
        return $this;
    }

    public function getFileName ()
    {
        return $this->filename;
    }

    public function getLength ()
    {
        if ($this->length >= 1073741824) {
            return round($this->length / 1073741824 * 100) / 100 .' Go';
        }
        elseif ($this->length >= 1048576) {
            return round($this->length / 1048576 * 100) / 100 .' Mo';
        }
        elseif ($this->length >= 1024) {
            return round($this->length / 1024 * 100) / 100 .' Ko';
        }
        else {
            return $this->length.' o';
        }
    }
}