<?php

namespace Acme\DemoBundle\Tests\Form\Type;

use Acme\DemoBundle\Model\Article;
use atoum\AtoumBundle\Test\Form\FormTestCase;
use Symfony\Component\HttpFoundation\Request;
use \Acme\DemoBundle\Form\Type\ArticleType as BaseArticleType;

class ArticleType extends FormTestCase
{

    /**
     * @dataProvider formTypeDataProvider
     */
    public function testFormType()
    {
        $formData = array(
            'texte1' => 'test 1',
            'texte2' => 'test 2',
        );

        $type = new BaseArticleType();
        $form = $this->factory->createBuilder($type);

        $object = new Article();
        $object->fromArray($formData);

        // submit the data to the form directly
        $form->submit($formData);

        $this->boolean($form->isSynchronized())->isTrue();
        $this->variable($object)->isEqualTo($form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->array($formData)->hasKey($key);
        }
    }


    public function formTypeDataProvider()
    {
        $formData = array(
            'texte1' => 'test 1',
            'texte2' => 'test 2',
        );

        return $formData;
    }
}