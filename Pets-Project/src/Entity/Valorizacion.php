<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ValorizacionRepository")
 */
class Valorizacion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numVotos;

    /**
     * @ORM\Column(type="smallint")
     */
    private $puntos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Paquete", inversedBy="valorizacion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $paquete;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumVotos(): ?int
    {
        return $this->numVotos;
    }

    public function setNumVotos(int $numVotos): self
    {
        $this->numVotos = $numVotos;

        return $this;
    }

    public function getPuntos(): ?int
    {
        return $this->puntos;
    }

    public function setPuntos(int $puntos): self
    {
        $this->puntos = $puntos;

        return $this;
    }

    public function getPaquete(): ?Paquete
    {
        return $this->paquete;
    }

    public function setPaquete(?Paquete $paquete): self
    {
        $this->paquete = $paquete;

        return $this;
    }
}
