<?php

namespace App\Entity;

use App\Repository\ArtistsTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: ArtistsTypesRepository::class)]
/**
 * @ORM\Entity(repositoryClass="ArtistsTypesRepository::class")
 * @ORM\Table(name="artist_type",uniqueConstraints={
 *       @UniqueConstraint(name="artist_type_idx", columns={"artist_id", "type_id"})})
 * @UniqueEntity(
 *      fields={"artist","type"},
 *      message="This artist is already defined for this type of job in the database."
 * )
 */

class ArtistsTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Artists::class, inversedBy : 'types')]
    #[ORM\JoinColumn(nullable: false)]
    private $artist;

    #[ORM\ManyToOne(targetEntity: Types::class, inversedBy : 'artists')]
    #[ORM\JoinColumn(nullable: false)]
    private $type;

    #[ORM\ManyToMany(targetEntity: Shows::class, mappedBy: 'artistsTypes')]
    private $shows;

    public function __construct()
    {
        $this->shows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArtist(): ?Artists
    {
        return $this->artist;
    }

    public function setArtist(?Artists $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getType(): ?Types
    {
        return $this->type;
    }

    public function setType(?Types $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Shows>
     */
    public function getShows(): Collection
    {
        return $this->shows;
    }

    public function addShow(Shows $shows): self
    {
        if (!$this->shows->contains($shows)) {
            $this->shows[] = $shows;
            $shows->addArtistType($this);
        }

        return $this;
    }

    public function removeShow(Shows $shows): self
    {
        if ($this->shows->contains($shows)){
            $this->shows->removeElement($shows);
            $shows->removeArtistType($this);
        }

        return $this;
    }
}

