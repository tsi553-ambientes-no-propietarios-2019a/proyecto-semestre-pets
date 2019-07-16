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
}
