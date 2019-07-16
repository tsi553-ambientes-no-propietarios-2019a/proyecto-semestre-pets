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
<<<<<<< HEAD
    private $Hora_Inicio;
=======
    private $Start_Time;
>>>>>>> 9290f0b2ebcdca55e13e8378efaa9b2fc905c190

    /**
     * @ORM\Column(type="datetime")
     */
<<<<<<< HEAD
    private $Hora_Fin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Paquete", inversedBy="servicios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Servicio_Paquete;
=======
    private $time_end;
>>>>>>> 9290f0b2ebcdca55e13e8378efaa9b2fc905c190

    public function getId(): ?int
    {
        return $this->id;
    }

<<<<<<< HEAD
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
=======
    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->Start_Time;
    }

    public function setStartTime(\DateTimeInterface $Start_Time): self
    {
        $this->Start_Time = $Start_Time;
>>>>>>> 9290f0b2ebcdca55e13e8378efaa9b2fc905c190

        return $this;
    }

<<<<<<< HEAD
    public function getServicioPaquete(): ?Paquete
    {
        return $this->Servicio_Paquete;
    }

    public function setServicioPaquete(?Paquete $Servicio_Paquete): self
    {
        $this->Servicio_Paquete = $Servicio_Paquete;
=======
    public function getTimeEnd(): ?\DateTimeInterface
    {
        return $this->time_end;
    }

    public function setTimeEnd(\DateTimeInterface $time_end): self
    {
        $this->time_end = $time_end;
>>>>>>> 9290f0b2ebcdca55e13e8378efaa9b2fc905c190

        return $this;
    }
}
