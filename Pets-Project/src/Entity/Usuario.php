<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Usuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Correo;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Celular;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Telefono;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Direccion;

    /**
     * @ORM\Column(type="integer")
     */
    private $Estado_Cli;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getUsuario(): ?string
    {
        return $this->Usuario;
    }

    public function setUsuario(string $Usuario): self
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->Correo;
    }

    public function setCorreo(string $Correo): self
    {
        $this->Correo = $Correo;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->Celular;
    }

    public function setCelular(string $Celular): self
    {
        $this->Celular = $Celular;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->Telefono;
    }

    public function setTelefono(string $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->Direccion;
    }

    public function setDireccion(string $Direccion): self
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    public function getEstadoCli(): ?int
    {
        return $this->Estado_Cli;
    }

    public function setEstadoCli(int $Estado_Cli): self
    {
        $this->Estado_Cli = $Estado_Cli;

        return $this;
    }
}
