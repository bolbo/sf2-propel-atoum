<?php

namespace Acme\DemoBundle\Tests\Controller;

use atoum\AtoumBundle\Test\Units\WebTestCase;
use atoum\AtoumBundle\Test\Controller\ControllerTest;

class ArticleController extends ControllerTest
{
    public function testGet()
    {
        $this
            ->request(array('debug' => true))
            ->GET('/article/list')
            ->hasStatus(200)
            ->hasCharset('UTF-8')
            ->hasVersion('1.1')
            ->POST('/article/add')
            ->hasHeader('Content-Type', 'text/html; charset=UTF-8')
            ->crawler
            ->hasElement('#form_article')
            ->hasChild('input')->exactly(4)->end()
            ->hasChild('input')
            ->withAttribute('type', 'text')
            ->withAttribute('name', 'article[code]')
            ->end()
            ->hasChild('input')
            ->withAttribute('type', 'text')
            ->withAttribute('name', 'article[intitule]')
            ->end()
            ->hasChild('input')
            ->withAttribute('type', 'text')
            ->withAttribute('name', 'article[description]')
            ->end()
            ->hasChild('button[type=submit]')
            ->end();
    }


    public function testShowErrorId()
    {
        $this
            ->request(array('debug' => true))
            ->GET('/article/show/100')
            ->hasStatus(404)
            ->hasCharset('UTF-8')
            ->hasVersion('1.1');
    }


    public function testShowArticle()
    {
        $this
            ->request(array('debug' => true))
            ->GET('/article/show/1')
            ->hasStatus(200)
            ->hasCharset('UTF-8')
            ->hasVersion('1.1');
    }


}