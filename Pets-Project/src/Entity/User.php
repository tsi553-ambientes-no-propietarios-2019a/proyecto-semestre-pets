<?php
// src/Entity/User.php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Anfitrion", mappedBy="anfitrion", cascade={"persist", "remove"})
     */
    private $anfitrion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mascota", mappedBy="user")
     */
    private $mascotas;

    public function __construct()
    {
        parent::__construct();
        $this->mascotas = new ArrayCollection();
    }

    public function getName(): ?string
    {
        parent::__construct();
        // your own logic
    }

    public function getAnfitrion(): ?Anfitrion
    {
        return $this->anfitrion;
    }

    public function setAnfitrion(Anfitrion $anfitrion): self
    {
        $this->anfitrion = $anfitrion;

        // set the owning side of the relation if necessary
        if ($this !== $anfitrion->getAnfitrion()) {
            $anfitrion->setAnfitrion($this);
        }

        return $this;
    }

    /**
     * @return Collection|Mascota[]
     */
    public function getMascotas(): Collection
    {
        return $this->mascotas;
    }

    public function addMascota(Mascota $mascota): self
    {
        if (!$this->mascotas->contains($mascota)) {
            $this->mascotas[] = $mascota;
            $mascota->setUser($this);
        }

        return $this;
    }

    public function removeMascota(Mascota $mascota): self
    {
        if ($this->mascotas->contains($mascota)) {
            $this->mascotas->removeElement($mascota);
            // set the owning side to null (unless already changed)
            if ($mascota->getUser() === $this) {
                $mascota->setUser(null);
            }
        }

        return $this;
    }
} 
