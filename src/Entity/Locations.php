<?php

namespace App\Entity;

use App\Repository\LocationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping\JoinColumn;


#[ORM\Entity(repositoryClass: LocationsRepository::class)]
#[ORM\Table(name:'locations')]
#[UniqueEntity('slug')]
class Locations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60)]
    private $slug;

    #[ORM\Column(type: 'string', length: 60)]
    private $designation;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $address;

    #[ORM\ManyToOne(targetEntity: Localities::class, inversedBy: 'locations')]
    #[JoinColumn(onDelete :'RESTRICT')]
    private $locality;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $website;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $phone;

    #[ORM\OneToMany(mappedBy: 'location', targetEntity: Shows::class)]
    private $shows;

    #[ORM\OneToMany(mappedBy: 'the_location', targetEntity: Representations::class)]
    private $representations;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
        $this->representations = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getLocality(): ?Localities
    {
        return $this->locality;
    }

    public function setLocality(?Localities $locality): self
    {
        $this->locality = $locality;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

  

    /**
     * @return Collection<int, Representations>
     */
    public function getRepresentations(): Collection
    {
        return $this->representations;
    }

    public function addRepresentation(Representations $representation): self
    {
        if (!$this->representations->contains($representation)) {
            $this->representations[] = $representation;
            $representation->setTheLocation($this);
        }

        return $this;
    }

    public function removeRepresentation(Representations $representation): self
    {
        if ($this->representations->removeElement($representation)) {
            // set the owning side to null (unless already changed)
            if ($representation->getTheLocation() === $this) {
                $representation->setTheLocation(null);
            }
        }

        return $this;
    }
}
