<?php

/**
 * CategorieManager.php
 *
 * PHP version 5
 */

namespace Acme\DemoBundle\Manager;

use Acme\DemoBundle\Model\Categorie;

/**
 * CategorieManager
 *
 * PHP version 5
 *
 */
class CategorieManager extends BaseManager
{
    /**
     *
     * @param Categorie $categorie
     */
    public function save(Categorie $categorie)
    {
        $categorie->save();
    }

}