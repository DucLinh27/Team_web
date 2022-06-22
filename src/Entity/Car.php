<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Car_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Car_brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Car_price;

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="cars")
     */
    private $Supplier_ID;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="Car_ID")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCarName(): ?string
    {
        return $this->Car_name;
    }

    public function setCarName(string $Car_name): self
    {
        $this->Car_name = $Car_name;

        return $this;
    }

    public function getCarBrand(): ?string
    {
        return $this->Car_brand;
    }

    public function setCarBrand(string $Car_brand): self
    {
        $this->Car_brand = $Car_brand;

        return $this;
    }

    public function getCarPrice(): ?string
    {
        return $this->Car_price;
    }

    public function setCarPrice(string $Car_price): self
    {
        $this->Car_price = $Car_price;

        return $this;
    }

    public function getSupplierID(): ?Supplier
    {
        return $this->Supplier_ID;
    }

    public function setSupplierID(?Supplier $Supplier_ID): self
    {
        $this->Supplier_ID = $Supplier_ID;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCarID($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCarID() === $this) {
                $order->setCarID(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getCarName();
    }
}
