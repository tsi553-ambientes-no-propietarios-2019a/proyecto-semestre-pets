<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServiciosRepository")
 */
class Servicios
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="servicios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $servicio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServicio(): ?User
    {
        return $this->servicio;
    }

    public function setServicio(?User $servicio): self
    {
        $this->servicio = $servicio;

        return $this;
    }
}
