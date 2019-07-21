<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaqueteRepository")
 */
class Paquete
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
    private $Tipo_Masc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Alimento;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Aseo_Masc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Precio;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Servicio", mappedBy="Servicio_Paquete")
     */
    private $servicios;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Anfitrion", inversedBy="Id_adfitrion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $anfitrion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Valorizacion", mappedBy="paquete", orphanRemoval=true)
     */
    private $valorizacion;

    public function __construct()
    {
        $this->servicios = new ArrayCollection();
        $this->valorizacion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoMasc(): ?string
    {
        return $this->Tipo_Masc;
    }

    public function setTipoMasc(string $Tipo_Masc): self
    {
        $this->Tipo_Masc = $Tipo_Masc;

        return $this;
    }

    public function getAlimento(): ?string
    {
        return $this->Alimento;
    }

    public function setAlimento(string $Alimento): self
    {
        $this->Alimento = $Alimento;

        return $this;
    }

    public function getAseoMasc(): ?string
    {
        return $this->Aseo_Masc;
    }

    public function setAseoMasc(string $Aseo_Masc): self
    {
        $this->Aseo_Masc = $Aseo_Masc;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->Precio;
    }

    public function setPrecio(string $Precio): self
    {
        $this->Precio = $Precio;

        return $this;
    }

    /**
     * @return Collection|Servicio[]
     */
    public function getServicios(): Collection
    {
        return $this->servicios;
    }

    public function addServicio(Servicio $servicio): self
    {
        if (!$this->servicios->contains($servicio)) {
            $this->servicios[] = $servicio;
            $servicio->setServicioPaquete($this);
        }

        return $this;
    }

    public function removeServicio(Servicio $servicio): self
    {
        if ($this->servicios->contains($servicio)) {
            $this->servicios->removeElement($servicio);
            // set the owning side to null (unless already changed)
            if ($servicio->getServicioPaquete() === $this) {
                $servicio->setServicioPaquete(null);
            }
        }

        return $this;
    }

    public function getAnfitrion(): ?Anfitrion
    {
        return $this->anfitrion;
    }

    public function setAnfitrion(?Anfitrion $anfitrion): self
    {
        $this->anfitrion = $anfitrion;

        return $this;
    }

    /**
     * @return Collection|Valorizacion[]
     */
    public function getValorizacion(): Collection
    {
        return $this->valorizacion;
    }

    public function addValorizacion(Valorizacion $valorizacion): self
    {
        if (!$this->valorizacion->contains($valorizacion)) {
            $this->valorizacion[] = $valorizacion;
            $valorizacion->setPaquete($this);
        }

        return $this;
    }

    public function removeValorizacion(Valorizacion $valorizacion): self
    {
        if ($this->valorizacion->contains($valorizacion)) {
            $this->valorizacion->removeElement($valorizacion);
            // set the owning side to null (unless already changed)
            if ($valorizacion->getPaquete() === $this) {
                $valorizacion->setPaquete(null);
            }
        }

        return $this;
    }
}
