<?php

namespace App\Entity;

use App\Repository\ImageBienRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageBienRepository::class)]
class ImageBien

{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomimage;

    #[ORM\ManyToOne(targetEntity: Bien::class, inversedBy: 'lesimages')]
    private $lebien;

   

    public function getId(): ?int
    {
        return $this->id;
    }
 
    public function getNomImage(): ?string
    {
        return $this->nomimage;
    }

    public function setNomImage(string $nomimage): self
    {
        $this->nomimage = $nomimage;

        return $this;
    }

    public function __toString()
    {
    return $this->id;
    }

    public function getLebien(): ?Bien
    {
        return $this->lebien;
    }

    public function setLebien(?Bien $lebien): self
    {
        $this->lebien = $lebien;

        return $this;
    }
 
}
