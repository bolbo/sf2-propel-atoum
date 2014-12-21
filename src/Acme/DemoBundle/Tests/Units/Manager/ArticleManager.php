<?php
namespace Acme\DemoBundle\Tests\Units\Manager;

require_once __DIR__.'/../Test.php';

use Acme\DemoBundle\Tests\Units\Test;

use \Acme\DemoBundle\Manager\ArticleManager as TestedElement;
use \Acme\DemoBundle\Model\Article;

class ArticleManager extends Test
{
    public function testGetClass()
    {
        $testedElement = new TestedElement('Acme\DemoBundle\Model\Article');
        $this
            ->class(get_class($testedElement))
            ->class('\Acme\DemoBundle\Manager\ArticleManager');
        $this
            ->class($testedElement)
            ->hasMethod('save');

        $mockArticle                       = new \mock\Acme\DemoBundle\Model\Article();
        $this->calling($mockArticle)->save = function () {
        };

        $mockArticle->setIntitule('test article');
        $mockArticle->setDescription('description article');
        $this
            ->if($testedElement->save($mockArticle))
            ->then
            ->string($mockArticle->getIntitule())
            ->string('test article');

    }
}