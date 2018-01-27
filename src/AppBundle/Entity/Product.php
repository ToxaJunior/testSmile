<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="WarehouseProducts", mappedBy="product")
     */
    private $warehouseProducts;

    /**
     * Product constructor.
     */
    public function __construct()
    {
        $this->warehouseProducts = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getWarehouseProducts()
    {
        return $this->warehouseProducts;
    }

    /**
     * @param WarehouseProducts $warehouseProduct
     * @return $this
     */
    public function addWarehouseProduct(WarehouseProducts $warehouseProduct)
    {
        $this->warehouseProducts[] = $warehouseProduct;

        return $this;
    }

    /**
     * @param WarehouseProducts $warehouseProduct
     */
    public function removeWarehouseProduct(WarehouseProducts $warehouseProduct)
    {
        $this->warehouseProducts->removeElement($warehouseProduct);
    }
}

