<?php
namespace Acme\DemoBundle\Tests\Units\Model;

require_once __DIR__.'/../Test.php';

use Acme\DemoBundle\Tests\Units\Test;
use \Acme\DemoBundle\Model\Article as TestedElement;

class Article extends Test
{
    public function testGetIntitule()
    {
        $this
            ->if($article = new TestedElement())
            ->and($article->setIntitule('Batmobile'))
            ->string($article->getIntitule())
            ->isEqualTo('Batmobile')
            ->isNotEqualTo('De Lorean');
    }
}