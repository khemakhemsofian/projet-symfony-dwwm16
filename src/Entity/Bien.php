<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection; 
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 50)]
    private $photo;

    #[ORM\Column(type: 'boolean')]
    private $vente;

    #[ORM\Column(type: 'string', length: 50)]
    private $type;

    #[ORM\Column(type: 'integer')]
    private $surface;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $tailleDuTerrain;

    #[ORM\Column(type: 'integer')]
    private $nombreDePiece;

    #[ORM\Column(type: 'integer')]
    private $etage;

    #[ORM\Column(type: 'string', length: 255)]
    private $Adresse;

    #[ORM\Column(type: 'integer')]
    private $prix;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $DateDeConstruction;

    #[ORM\OneToMany(mappedBy: 'bien', targetEntity: OptionBien::class, orphanRemoval: true)]
    private $options;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'biens')]
    #[ORM\JoinColumn(nullable: false)]
    private $agent;

    #[ORM\OneToMany(mappedBy: 'bien', targetEntity: Mail::class)]
    private $bien;

    #[ORM\OneToMany(mappedBy: 'lebien', targetEntity: ImageBien::class)]
    private $lesimages;



  

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->bien = new ArrayCollection();
        $this->lesimages = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getVente(): ?bool
    {
        return $this->vente;
    }

    public function setVente(bool $vente): self
    {
        $this->vente = $vente;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getTailleDuTerrain(): ?int
    {
        return $this->tailleDuTerrain;
    }

    public function setTailleDuTerrain(?int $tailleDuTerrain): self
    {
        $this->tailleDuTerrain = $tailleDuTerrain;

        return $this;
    }

    public function getNombreDePiece(): ?int
    {
        return $this->nombreDePiece;
    }

    public function setNombreDePiece(int $nombreDePiece): self
    {
        $this->nombreDePiece = $nombreDePiece;

        return $this;
    }

    public function getEtage(): ?int
    {
        return $this->etage;
    }

    public function setEtage(int $etage): self
    {
        $this->etage = $etage;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateDeConstruction(): ?\DateTimeInterface
    {
        return $this->DateDeConstruction;
    }

    public function setDateDeConstruction(?\DateTimeInterface $DateDeConstruction): self
    {
        $this->DateDeConstruction = $DateDeConstruction;

        return $this;
    }

    /**
     * @return Collection<int, OptionBien>
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(OptionBien $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->setBien($this);
        }

        return $this;
    }

    public function removeOption(OptionBien $option): self
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getBien() === $this) {
                $option->setBien(null);
            }
        }

        return $this;
    }

    public function getAgent(): ?User
    {
        return $this->agent;
    }

    public function setAgent(?User $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * @return Collection<int, Mail>
     */
    public function getBien(): Collection
    {
        return $this->bien;
    }

    public function addBien(Mail $bien): self
    {
        if (!$this->bien->contains($bien)) {
            $this->bien[] = $bien;
            $bien->setBien($this);
        }

        return $this;
    }

    public function removeBien(Mail $bien): self
    {
        if ($this->bien->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getBien() === $this) {
                $bien->setBien(null);
            }
        }

        return $this;
    }

    
    
    public function __toString()
    {
    return $this->id;
    }

    /**
     * @return Collection<int, ImageBien>
     */
    public function getLesimages(): Collection
    {
        return $this->lesimages;
    }

    public function addLesimage(ImageBien $lesimage): self
    {
        if (!$this->lesimages->contains($lesimage)) {
            $this->lesimages[] = $lesimage;
            $lesimage->setLebien($this);
        }

        return $this;
    }

    public function removeLesimage(ImageBien $lesimage): self
    {
        if ($this->lesimages->removeElement($lesimage)) {
            // set the owning side to null (unless already changed)
            if ($lesimage->getLebien() === $this) {
                $lesimage->setLebien(null);
            }
        }

        return $this;
    }

   
}
