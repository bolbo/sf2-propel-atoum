<?php

/**
 * ArticleManager.php
 *
 * PHP version 5
 */

namespace Acme\DemoBundle\Manager;

use Acme\DemoBundle\Model\Article;

/**
 * ArticleManager
 *
 * PHP version 5
 *
 */
class ArticleManager extends BaseManager
{
    /**
     *
     * @param Article $article
     */
    public function save(Article $article)
    {
        $article->save();
    }

}