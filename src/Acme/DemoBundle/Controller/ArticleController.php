<?php
/**
 * ArticleController.php
 *
 * PHP version 5
 */
namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\Handler\ArticleHandler;

/**
 * Class ArticleController
 *
 * @package Acme\DemoBundle\Controller
 */
class ArticleController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $articleManager = $this->container->get('acme_demo_article_manager');
        $list           = $articleManager->findAll();

        return $this->render('AcmeDemoBundle:Article:list.html.twig', array('list' => $list));
    }


    /**
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id)
    {
        $articleManager = $this->container->get('acme_demo_article_manager');
        $element        = $articleManager->findOneById($id);
        //var_dump($element);
        //exit;

        if (null === $element) {
            throw $this->createNotFoundException('Article not found');
        }

        return $this->render('AcmeDemoBundle:Article:show.html.twig', array('element' => $element));
    }


    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $articleManager = $this->get('acme_demo_article_manager');
        $article        = $articleManager->create();

        $form = $this->get('acme_demo.form.article');
        $form->setData($article);

        $formHandler = new ArticleHandler(
            $form,
            $request,
            $articleManager
        );

        if ($formHandler->process()) {
            return $this->redirectToRoute(
                'acme_demo_article_list',
                array()
            );
        }

        return $this->render(
            'AcmeDemoBundle:Article:form.html.twig',
            array(
                'action'  => 'add',
                'element' => $article,
                'form'    => $form->createView()
            )
        );
    }
}
