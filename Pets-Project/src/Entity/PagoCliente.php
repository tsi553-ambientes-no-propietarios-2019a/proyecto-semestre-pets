<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PagoClienteRepository")
 */
class PagoCliente
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
    private $nombre;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $apellido;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaccion", mappedBy="transaccion")
     */
    private $transaccions;

    public function __construct()
    {
        $this->transaccions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->create_at;
    }

    public function setCreateAt(\DateTimeInterface $create_at): self
    {
        $this->create_at = $create_at;

        return $this;
    }

    /**
     * @return Collection|Transaccion[]
     */
    public function getTransaccions(): Collection
    {
        return $this->transaccions;
    }

    public function addTransaccion(Transaccion $transaccion): self
    {
        if (!$this->transaccions->contains($transaccion)) {
            $this->transaccions[] = $transaccion;
            $transaccion->setTransaccion($this);
        }

        return $this;
    }

    public function removeTransaccion(Transaccion $transaccion): self
    {
        if ($this->transaccions->contains($transaccion)) {
            $this->transaccions->removeElement($transaccion);
            // set the owning side to null (unless already changed)
            if ($transaccion->getTransaccion() === $this) {
                $transaccion->setTransaccion(null);
            }
        }

        return $this;
    }
}
