<?php
/**
 * Created by PhpStorm.
 * User: toxa
 * Date: 27.01.18
 * Time: 12:03
 */

namespace AppBundle\Interfaces;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface ImportInterface
 * @package AppBundle\Interfaces
 */
interface ImportInterface
{
    /**
     * @param UploadedFile $file
     * @return mixed
     */
    public function import(UploadedFile $file);
}