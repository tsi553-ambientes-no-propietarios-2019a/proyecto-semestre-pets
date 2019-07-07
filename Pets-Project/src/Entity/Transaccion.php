<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransaccionRepository")
 */
class Transaccion
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
    private $producto;

    /**
     * @ORM\Column(type="integer")
     */
    private $monto;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $divisa;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $estado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $create_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PagoCliente", inversedBy="transaccions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pagoCliente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducto(): ?string
    {
        return $this->producto;
    }

    public function setProducto(string $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getMonto(): ?int
    {
        return $this->monto;
    }

    public function setMonto(int $monto): self
    {
        $this->monto = $monto;

        return $this;
    }

    public function getDivisa(): ?string
    {
        return $this->divisa;
    }

    public function setDivisa(string $divisa): self
    {
        $this->divisa = $divisa;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

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

    public function getPagoCliente(): ?PagoCliente
    {
        return $this->pagoCliente;
    }

    public function setPagoCliente(?PagoCliente $pagoCliente): self
    {
        $this->pagoCliente = $pagoCliente;

        return $this;
    }
}
