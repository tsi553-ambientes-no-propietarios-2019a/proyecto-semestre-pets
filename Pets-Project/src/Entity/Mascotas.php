<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MascotasRepository")
 */
class Mascotas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mascotas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mascota;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMascota(): ?User
    {
        return $this->mascota;
    }

    public function setMascota(?User $mascota): self
    {
        $this->mascota = $mascota;

        return $this;
    }
}
