<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WarehouseProducts
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WarehouseProductsRepository")
 */
class WarehouseProducts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var Warehouse
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Warehouse", inversedBy="warehouseProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $warehouse;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="warehouseProducts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return Warehouse
     */
    public function getWarehouse(): Warehouse
    {
        return $this->warehouse;
    }

    /**
     * @param Warehouse $warehouse
     * @return $this
     */
    public function setWarehouse(Warehouse $warehouse)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }
}

