<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CobroAnfRepository")
 */
class CobroAnf
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comision;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Transaccion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Id_Transaccion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComision(): ?string
    {
        return $this->comision;
    }

    public function setComision(string $comision): self
    {
        $this->comision = $comision;

        return $this;
    }

    public function getIdTransaccion(): ?Transaccion
    {
        return $this->Id_Transaccion;
    }

    public function setIdTransaccion(Transaccion $Id_Transaccion): self
    {
        $this->Id_Transaccion = $Id_Transaccion;

        return $this;
    }
}
