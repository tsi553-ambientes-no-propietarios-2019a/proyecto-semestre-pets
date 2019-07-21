<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnfitrionRepository")
 * @Vich\Uploadable
 */
class Anfitrion
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
    private $cuenta;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CobroAnf", inversedBy="anfitrion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAnfitrion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paquete", mappedBy="anfitrion")
     */
    private $Id_adfitrion;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="anfitrion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $anfitrion;

    public function __construct()
    {
        $this->Id_adfitrion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCuenta(): ?string
    {
        return $this->cuenta;
    }

    public function setCuenta(string $cuenta): self
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    public function getIdAnfitrion(): ?CobroAnf
    {
        return $this->idAnfitrion;
    }

    public function setIdAnfitrion(CobroAnf $idAnfitrion): self
    {
        $this->idAnfitrion = $idAnfitrion;

        return $this;
    }

    /**
     * @return Collection|Paquete[]
     */
    public function getIdAdfitrion(): Collection
    {
        return $this->Id_adfitrion;
    }

    public function addIdAdfitrion(Paquete $idAdfitrion): self
    {
        if (!$this->Id_adfitrion->contains($idAdfitrion)) {
            $this->Id_adfitrion[] = $idAdfitrion;
            $idAdfitrion->setAnfitrion($this);
        }

        return $this;
    }

    public function removeIdAdfitrion(Paquete $idAdfitrion): self
    {
        if ($this->Id_adfitrion->contains($idAdfitrion)) {
            $this->Id_adfitrion->removeElement($idAdfitrion);
            // set the owning side to null (unless already changed)
            if ($idAdfitrion->getAnfitrion() === $this) {
                $idAdfitrion->setAnfitrion(null);
            }
        }

        return $this;
    }

    public function getAnfitrion(): ?User
    {
        return $this->anfitrion;
    }

    public function setAnfitrion(User $anfitrion): self
    {
        $this->anfitrion = $anfitrion;

        return $this;
    }

}
