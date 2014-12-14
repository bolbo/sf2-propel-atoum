<?php

/**
 * ArticleType.php
 *
 * PHP version 5
 *
 */
namespace Acme\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Formulaire Article
 *
 * PHP version 5
 *
 */
class ArticleType extends AbstractType
{

    /**
     * @var Request
     */
    protected $request;


    /**
     */
    public function __construct() {
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'code',
            'text',
            array(
                'required' => true,
                'label'    => 'acme.demo.article.code',
                'attr'     => array(
                    'placeholder' => 'acme.demo.article.code',
                ),
            )
        );
        $builder->add(
            'intitule',
            'text',
            array(
                'required' => true,
                'label'    => 'acme.demo.article.intitule',
                'attr'     => array(
                    'placeholder' => 'acme.demo.article.intitule',
                ),
            )
        );
        $builder->add(
            'description',
            'text',
            array(
                'required' => false,
                'label'    => 'acme.demo.article.description',
                'attr'     => array(
                    'placeholder' => 'acme.demo.article.description',
                ),
            )
        );

        $builder->add(
            'categorie',
            'model',
            array(
                'class'    => 'Acme\DemoBundle\Model\Categorie',
                'property' => 'intitule',
            )
        );

        $builder->add('save', 'submit', array('label' => 'Submit'));

    }


    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class'      => 'Acme\DemoBundle\Model\Article',
                'intention'       => 'acme_demo_article_form',
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
            )
        );
    }


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'acme_demo_article_type';
    }
}
