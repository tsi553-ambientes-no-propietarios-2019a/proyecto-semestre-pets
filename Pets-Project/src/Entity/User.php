<?php
// src/Entity/User.php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mascota", mappedBy="user")
     */
    private $mascotas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Servicio", mappedBy="user")
     */
    private $servicios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Paquete", mappedBy="user", orphanRemoval=true)
     */
    private $paquetes;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CobroAnf", mappedBy="user", cascade={"persist", "remove"})
     */
    private $cobroAnf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cuenta_banco;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="user_imagen", fileNameProperty="imageName", size="imageSize")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="integer")
     *
     * @var integer
     */
    private $imageSize;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    
    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }


    public function __construct()
    {
        parent::__construct();
        $this->mascotas = new ArrayCollection();
        $this->servicios = new ArrayCollection();
        $this->paquetes = new ArrayCollection();
    }

    /**
     * @return Collection|Mascota[]
     */
    public function getMascotas(): Collection
    {
        return $this->mascotas;
    }

    public function addMascota(Mascota $mascota): self
    {
        if (!$this->mascotas->contains($mascota)) {
            $this->mascotas[] = $mascota;
            $mascota->setUser($this);
        }

        return $this;
    }

    public function removeMascota(Mascota $mascota): self
    {
        if ($this->mascotas->contains($mascota)) {
            $this->mascotas->removeElement($mascota);
            // set the owning side to null (unless already changed)
            if ($mascota->getUser() === $this) {
                $mascota->setUser(null);
            }
        }

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
            $servicio->setUser($this);
        }

        return $this;
    }

    public function removeServicio(Servicio $servicio): self
    {
        if ($this->servicios->contains($servicio)) {
            $this->servicios->removeElement($servicio);
            // set the owning side to null (unless already changed)
            if ($servicio->getUser() === $this) {
                $servicio->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Paquete[]
     */
    public function getPaquetes(): Collection
    {
        return $this->paquetes;
    }

    public function addPaquete(Paquete $paquete): self
    {
        if (!$this->paquetes->contains($paquete)) {
            $this->paquetes[] = $paquete;
            $paquete->setUser($this);
        }

        return $this;
    }

    public function removePaquete(Paquete $paquete): self
    {
        if ($this->paquetes->contains($paquete)) {
            $this->paquetes->removeElement($paquete);
            // set the owning side to null (unless already changed)
            if ($paquete->getUser() === $this) {
                $paquete->setUser(null);
            }
        }

        return $this;
    }

    public function getCobroAnf(): ?CobroAnf
    {
        return $this->cobroAnf;
    }

    public function setCobroAnf(CobroAnf $cobroAnf): self
    {
        $this->cobroAnf = $cobroAnf;

        // set the owning side of the relation if necessary
        if ($this !== $cobroAnf->getUser()) {
            $cobroAnf->setUser($this);
        }

        return $this;
    }

    public function getCuentaBanco(): ?string
    {
        return $this->cuenta_banco;
    }

    public function setCuentaBanco(?string $cuenta_banco): self
    {
        $this->cuenta_banco = $cuenta_banco;

        return $this;
    }

    
} 
