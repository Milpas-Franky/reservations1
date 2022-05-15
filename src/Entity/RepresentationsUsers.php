<?php

namespace App\Entity;

use App\Repository\RepresentationsUsersRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;


#[ORM\Entity(repositoryClass: RepresentationsUsersRepository::class)]
#[ORM\Table(name:'representations_users')]

class RepresentationsUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]

    #[ORM\OneToMany(targetEntity: Representations::class, inversedBy: 'representations_users')]
    #[ORM\JoinColumn(nullable: false, name: 'representations_id', referencedColumnName:'id', onDelete:'RESTRICT')]
    
    private $representations;

    #[ORM\Column(type: 'string', length: 255)]

    
    #[ORM\OneToMany(targetEntity:Users::class, inversedBy:'representations_users')]
    #[ORM\JoinColumn(nullable: false, name:'users_id', referencedColumnName:'id', onDelete:'RESTRICT')]
    

    private $users;

    #[ORM\Column(type: 'string', length: 11)]
    private $places;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRepresentations(): ?string
    {
        return $this->representations;
    }

    public function setRepresentations(string $representations): self
    {
        $this->representations = $representations;

        return $this;
    }

    public function getUsers(): ?string
    {
        return $this->users;
    }

    public function setUsers(string $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getPlaces(): ?string
    {
        return $this->places;
    }

    public function setPlaces(string $places): self
    {
        $this->places = $places;

        return $this;
    }
}
