<?php
namespace Acme\DemoBundle\Tests\Units\Model;

require_once __DIR__ . '/../Test.php';

use Acme\DemoBundle\Tests\Units\Test;

class Article extends Test
{
    /*public function testGetName()
    {
        $this
            ->if($article = new \Acme\DemoBundle\Model\Article())
            ->and($article->setIntitule('Batmobile'))
            ->string($article->getIntitule())
            ->isEqualTo('Batmobile')
            ->isNotEqualTo('De Lorean')
        ;
    }*/

    public function testGetName()
    {
        $this
            ->if($article = new \Acme\DemoBundle\Model\Article())
            ->and($article->setIntitule('Batmobile'))
            ->string($article->getIntitule())
            ->isEqualTo('Batmobile')
            ->isNotEqualTo('De Lorean')
        ;
    }
}