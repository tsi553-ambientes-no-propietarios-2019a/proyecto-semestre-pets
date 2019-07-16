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
     * @ORM\OneToMany(targetEntity="App\Entity\Mascotas", mappedBy="mascota")
     */
    private $mascotas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Servicios", mappedBy="servicio")
     */
    private $servicios;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Anfitrion", mappedBy="anfitrion", cascade={"persist", "remove"})
     */
    private $anfitrion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mascota", mappedBy="mascota")
     */
    private $mascota;

    public function __construct()
    {
        parent::__construct();
        $this->mascotas = new ArrayCollection();
        $this->servicios = new ArrayCollection();
        $this->mascota = new ArrayCollection();
    }

    public function getName(): ?string
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @return Collection|Mascotas[]
     */
    public function getMascotas(): Collection
    {
        return $this->mascotas;
    }

    public function addMascota(Mascotas $mascota): self
    {
        if (!$this->mascotas->contains($mascota)) {
            $this->mascotas[] = $mascota;
            $mascota->setMascota($this);
        }

        return $this;
    }

    public function removeMascota(Mascotas $mascota): self
    {
        if ($this->mascotas->contains($mascota)) {
            $this->mascotas->removeElement($mascota);
            // set the owning side to null (unless already changed)
            if ($mascota->getMascota() === $this) {
                $mascota->setMascota(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Servicios[]
     */
    public function getServicios(): Collection
    {
        return $this->servicios;
    }

    public function addServicio(Servicios $servicio): self
    {
        if (!$this->servicios->contains($servicio)) {
            $this->servicios[] = $servicio;
            $servicio->setServicio($this);
        }

        return $this;
    }

    public function removeServicio(Servicios $servicio): self
    {
        if ($this->servicios->contains($servicio)) {
            $this->servicios->removeElement($servicio);
            // set the owning side to null (unless already changed)
            if ($servicio->getServicio() === $this) {
                $servicio->setServicio(null);
            }
        }

        return $this;
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
    public function getMascota(): Collection
    {
        return $this->mascota;
    }

    public function addMascotum(Mascota $mascotum): self
    {
        if (!$this->mascota->contains($mascotum)) {
            $this->mascota[] = $mascotum;
            $mascotum->setMascota($this);
        }

        return $this;
    }

    public function removeMascotum(Mascota $mascotum): self
    {
        if ($this->mascota->contains($mascotum)) {
            $this->mascota->removeElement($mascotum);
            // set the owning side to null (unless already changed)
            if ($mascotum->getMascota() === $this) {
                $mascotum->setMascota(null);
            }
        }

        return $this;
    }
    
} 
