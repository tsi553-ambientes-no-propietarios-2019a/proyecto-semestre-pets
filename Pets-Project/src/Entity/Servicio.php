<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicioRepository")
 */
class Servicio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Hora_Inicio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Hora_Fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Paquete", inversedBy="servicios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Servicio_Paquete;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PagoCliente", inversedBy="Id_Servicio")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pagoCliente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="servicios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHoraInicio(): ?\DateTimeInterface
    {
        return $this->Hora_Inicio;
    }

    public function setHoraInicio(\DateTimeInterface $Hora_Inicio): self
    {
        $this->Hora_Inicio = $Hora_Inicio;

        return $this;
    }

    public function getHoraFin(): ?\DateTimeInterface
    {
        return $this->Hora_Fin;
    }

    public function setHoraFin(\DateTimeInterface $Hora_Fin): self
    {
        $this->Hora_Fin = $Hora_Fin;

        return $this;
    }

    public function getServicioPaquete(): ?Paquete
    {
        return $this->Servicio_Paquete;
    }

    public function setServicioPaquete(?Paquete $Servicio_Paquete): self
    {
        $this->Servicio_Paquete = $Servicio_Paquete;

        return $this;
    }

    public function getPagoCliente(): ?PagoCliente
    {
        return $this->pagoCliente;
    }

    public function setPagoCliente(?PagoCliente $pagoCliente): self
    {
        $this->pagoCliente = $pagoCliente;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
