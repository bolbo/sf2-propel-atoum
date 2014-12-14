<?php

namespace Acme\DemoBundle\Tests\Units\Form\Type;

use Acme\DemoBundle\Model\Article;
use atoum\AtoumBundle\Test\Form;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\Type\ArticleType as MyTypeToTest;

class ArticleTypeTest extends Form\FormTestCase
{


    /**
     * @dataProvider formTypeDataProvider
     */
    public function testFormType(Request $request)
    {
        $formData = array(
            'texte1' => 'test 1',
            'texte2' => 'test 2',
        );

        $type = new MyTypeToTest();
        $form = $this->factory->create($type);

        $object = new Article();
        $object->fromArray($formData);

        // submit the data to the form directly
        $form->submit($formData);

        $this->boolean($form->isSynchronized())->isTrue();
        $this->variable($object)->isEqualTo($form->getData());

        $view     = $form->createView();
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