<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Roles;
use App\Entity\Users;



#[ORM\Entity(repositoryClass: RolesRepository::class)]
#[ORM\Table(name:'roles')]

class Roles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60)]
    private $role;

      
     #[ORM\ManyToMany(targetEntity: Users::class, mappedBy:'roles')]
     #[ORM\JoinTable(name:'users_roles')]
     
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }
}
