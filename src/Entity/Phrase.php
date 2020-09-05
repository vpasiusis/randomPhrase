<?php

namespace App\Entity;

use App\Repository\PhraseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhraseRepository::class)
 */
class Phrase
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @ORM\Column(type="text",length=100)
     */
    private $phrase;

     /**
     * @ORM\Column(type="text",length=6)
     */
    private $url_code;

     /**
     * @ORM\Column(type="text",length=5)
     */
    private $color;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhrase(){
        return $this->phrase;
    }
    public function setPhrase($phrase){
        $this->phrase=$phrase;
    }

    public function getUrl(){
        return $this->url_code;
    }
    public function setUrl($url_code){
        $this->url_code=$url_code;
    }

    public function getColor(){
        return $this->color;
    }
    public function setColor($color){
        $this->color=$color;
    }



}
