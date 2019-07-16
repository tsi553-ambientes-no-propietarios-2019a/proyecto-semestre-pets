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

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Anfitrion", mappedBy="idAnfitrion", cascade={"persist", "remove"})
     */
    private $anfitrion;

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

    public function getAnfitrion(): ?Anfitrion
    {
        return $this->anfitrion;
    }

    public function setAnfitrion(Anfitrion $anfitrion): self
    {
        $this->anfitrion = $anfitrion;

        // set the owning side of the relation if necessary
        if ($this !== $anfitrion->getIdAnfitrion()) {
            $anfitrion->setIdAnfitrion($this);
        }

        return $this;
    }
}
