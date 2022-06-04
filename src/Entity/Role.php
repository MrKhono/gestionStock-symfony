<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'role_id')]
    private $admin;

    public function __construct()
    {
        $this->admin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getAdmin(): Collection
    {
        return $this->admin;
    }

    public function addAdmin(Users $admin): self
    {
        if (!$this->admin->contains($admin)) {
            $this->admin[] = $admin;
            $admin->addRoleId($this);
        }

        return $this;
    }

    public function removeAdmin(Users $admin): self
    {
        if ($this->admin->removeElement($admin)) {
            $admin->removeRoleId($this);
        }

        return $this;
    }
}
