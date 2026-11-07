<?php

namespace App\Entity;

use App\Repository\UserServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserServiceRepository::class)]
class UserService
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'user_services')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'service_user')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $service_id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $ordered_at = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $price = null;

    #[ORM\Column]
    private ?bool $nfz_status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getServiceId(): ?Service
    {
        return $this->service_id;
    }

    public function setServiceId(?Service $service_id): static
    {
        $this->service_id = $service_id;

        return $this;
    }

    public function getOrderedAt(): ?\DateTimeImmutable
    {
        return $this->ordered_at;
    }

    public function setOrderedAt(\DateTimeImmutable $ordered_at): static
    {
        $this->ordered_at = $ordered_at;

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
        return $this->nfz_status;
    }

    public function setNfzStatus(bool $nfz_status): static
    {
        $this->nfz_status = $nfz_status;

        return $this;
    }
}
