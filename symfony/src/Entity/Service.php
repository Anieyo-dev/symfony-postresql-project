<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $price = null;

    #[ORM\Column]
    private ?bool $nfzStatus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, UserService>
     */
    #[ORM\OneToMany(targetEntity: UserService::class, mappedBy: 'service_id')]
    private Collection $service_user;

    public function __construct()
    {
        $this->service_user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isNfzStatus(): ?bool
    {
        return $this->nfzStatus;
    }

    public function setNfzStatus(bool $nfzStatus): static
    {
        $this->nfzStatus = $nfzStatus;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, UserService>
     */
    public function getServiceUser(): Collection
    {
        return $this->service_user;
    }

    public function addServiceUser(UserService $serviceUser): static
    {
        if (!$this->service_user->contains($serviceUser)) {
            $this->service_user->add($serviceUser);
            $serviceUser->setServiceId($this);
        }

        return $this;
    }

    public function removeServiceUser(UserService $serviceUser): static
    {
        if ($this->service_user->removeElement($serviceUser)) {
            // set the owning side to null (unless already changed)
            if ($serviceUser->getServiceId() === $this) {
                $serviceUser->setServiceId(null);
            }
        }

        return $this;
    }
}
