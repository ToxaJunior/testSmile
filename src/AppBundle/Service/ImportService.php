<?php
/**
 * Created by PhpStorm.
 * User: toxa
 * Date: 18.11.17
 * Time: 11:39
 */

namespace AppBundle\Service;

use AppBundle\Entity\Product;
use AppBundle\Entity\Warehouse;
use AppBundle\Entity\WarehouseProducts;
use AppBundle\Interfaces\ImportInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ImportService
 * @package AppBundle\Service
 */
class ImportService implements ImportInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ImportService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param UploadedFile $file
     * @return null
     */
    public function import(UploadedFile $file)
    {
        if ($file->guessExtension() != 'txt'){
            throw new \InvalidArgumentException("Wrong file format {$file->getClientOriginalName()}");
        }
        $data = str_getcsv(file_get_contents($file->getPathname()), "\n");
        foreach ($data as $row){
            $arr = str_getcsv($row);
            $productName = $arr[0];
            $quantity = (int)$arr[1];
            $warehouseName = $arr[2];
            $warehouse = $this->entityManager->getRepository(Warehouse::class)->findOneByName($warehouseName);
            $product = $this->entityManager->getRepository(Product::class)->findOneByName($productName);
            if (!$warehouse || !$product){
                throw new \InvalidArgumentException("Wrong file format {$file->getClientOriginalName()}");
            }
            if ($warehouse->getWarehouseProducts()->isEmpty()){
                $warehouseProduct = new WarehouseProducts();
                $warehouseProduct->setProduct($product)
                    ->setWarehouse($warehouse)
                    ->setQuantity($quantity);
                $this->entityManager->persist($warehouseProduct);
            }
            else{
                $warehouseProduct = $warehouse->getWarehouseProducts()->filter(function ($item) use($productName){
                    return $item->getProduct()->getName() == $productName;
                })->first();
                $warehouseProduct->setQuantity($warehouseProduct->getQuantity() + $quantity);
            }
        }
        $this->entityManager->flush();
    }
}