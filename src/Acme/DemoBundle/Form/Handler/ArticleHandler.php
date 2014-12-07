<?php

/**
 * ArticleHandler.php
 *
 * PHP version 5
 *
 */
namespace Acme\DemoBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * ArticleHandler
 *
 * PHP version 5
 *
 */
class ArticleHandler
{

    /**
     * Form
     *
     * @var \Symfony\Component\Form\Form
     */
    protected $form;

    /**
     * Request
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * Manager
     *
     * @var \Acme\DemoBundle\Manager\ArticleManager
     */
    protected $articleManager;


    /**
     *
     * @param Form                                    $form
     * @param Request                                 $request
     * @param \Acme\DemoBundle\Manager\ArticleManager $articleManager
     */
    public function __construct(
        Form $form,
        Request $request,
        $articleManager
    ) {
        $this->form           = $form;
        $this->request        = $request;
        $this->articleManager = $articleManager;
    }


    /**
     *
     * @param \Acme\DemoBundle\Model\Article $article
     */
    public function onSuccess(
        $article
    ) {

        $this->articleManager->save($article);
    }


    /**
     *
     * @return bool
     */
    public function process()
    {
        if ($this->request->getMethod() == 'POST') {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {
                $this->onSuccess(
                    $this->form->getData()
                );

                return true;
            }
        }

        return false;
    }
}
