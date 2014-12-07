<?php

/**
 * BaseManager.php
 *
 * PHP version 5
 *
 */
namespace Acme\DemoBundle\Manager;

/**
 * Base Manager
 *
 * PHP version 5
 *
 */
abstract class BaseManager
{

    /**
     * @var string class name
     */
    protected $class;


    /**
     * @param string $class class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }


    /**
     * @return mixed
     */
    public function create()
    {
        $class = $this->getClass();

        return new $class();
    }


    /**
     * create propel query
     *
     * @return \ModelCriteria
     */
    protected function createQuery()
    {
        return \PropelQuery::from($this->class);
    }


    /**
     * get class name
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }


    /**
     * List all elements
     *
     * @param null   $sortByField
     * @param string $sortOrder
     * @param bool   $pagination
     * @param int    $page
     * @param int    $maxPerPage
     *
     * @return mixed
     */
    public function findAll(
        $sortByField = null,
        $sortOrder = 'asc',
        $pagination = false,
        $page = 1,
        $maxPerPage = 10
    ) {
        $query = $this->createQuery();

        // sortOrder
        if (null !== $sortByField) {
            $query->orderBy($sortByField, $sortOrder);
        }

        // Pagination
        if (false === $pagination) {
            $element = $query->find();
        } else {
            $element = $query->paginate($page, $maxPerPage);
        }

        return $element;
    }


    /**
     * @param int $id
     *
     * @return mixed
     */
    public function findOneById($id)
    {
        return $this->findOneBy(array('id' => $id));

    }


    /**
     * @param array $criteria     Element filtre
     * @param array $joinCriteria Element filtre sur table croisee
     *
     * @return mixed
     */
    public function findOneBy(array $criteria, array $joinCriteria = null)
    {
        $query = $this->createQuery();

        foreach ($criteria as $field => $value) {
            $method = 'filterBy'.ucfirst($field);
            $query->$method($value);
        }

        if (!is_null($joinCriteria)) {
            foreach ($joinCriteria as $joinCriteriaElement) {
                if (isset($joinCriteriaElement['table']) && $joinCriteriaElement['table'] != ''
                    && isset($joinCriteriaElement['field']) && $joinCriteriaElement['field'] != ''
                    && isset($joinCriteriaElement['value']) && $joinCriteriaElement['value'] != ''
                ) {
                    $tableQuery = 'use'.ucfirst($joinCriteriaElement['table']).'Query';
                    $method     = 'filterBy'.ucfirst($joinCriteriaElement['field']);
                    $value      = $joinCriteriaElement['value'];

                    $query->$tableQuery()
                          ->$method(
                              $value
                          )
                          ->endUse();
                }
            }
        }

        $element = $query->findOne();

        return $element;
    }


    /**
     * search
     *
     * @see http://propelorm.org/Propel/documentation/03-basic-crud.html
     *
     * @param array  $criteria
     * @param null   $sortByField
     * @param string $sortOrder
     * @param bool   $pagination
     * @param int    $page
     * @param int    $maxPerPage
     * @param array  $joinCriteria
     *
     * @return array|mixed|\PropelModelPager|\PropelObjectCollection
     */
    public function findBy(
        array $criteria,
        $sortByField = null,
        $sortOrder = 'asc',
        $pagination = false,
        $page = 1,
        $maxPerPage = 10,
        array $joinCriteria = null
    ) {
        $query = $this->createQuery();

        foreach ($criteria as $field => $value) {

            if ($field == 'periode') {
                $query->filterByCreatedAt(
                    array(
                        "min" => $value['min']->format('Y-m-d H:i:s'),
                        "max" => $value['max']->format('Y-m-d H:i:s'),
                    )
                );
            } else {
                $method = 'filterBy'.ucfirst($field);
                $query->$method($value);
            }
        }

        if (!is_null($joinCriteria)) {
            foreach ($joinCriteria as $joinCriteriaElement) {
                if (isset($joinCriteriaElement['table']) && $joinCriteriaElement['table'] != ''
                    && isset($joinCriteriaElement['field']) && $joinCriteriaElement['field'] != ''
                    && isset($joinCriteriaElement['value']) && $joinCriteriaElement['value'] != ''
                ) {
                    $tableQuery = 'use'.ucfirst($joinCriteriaElement['table']).'Query';
                    $method     = 'filterBy'.ucfirst($joinCriteriaElement['field']);
                    $value      = $joinCriteriaElement['value'];

                    $query->$tableQuery()
                          ->$method(
                              $value
                          )
                          ->endUse();
                }
            }
        }


        // sortOrder
        if (null !== $sortByField) {
            if (is_string($sortByField)) {
                $query->orderBy($sortByField, $sortOrder);
            } else if (is_array($sortByField)) {
                foreach ($sortByField as $sort) {
                    $query->orderBy($sort, $sortOrder);
                }
            }
        }

        // Pagination
        if (false === $pagination) {
            $element = $query->find();
        } else {
            $element = $query->paginate($page, $maxPerPage);
        }

        return $element;
    }


    /**
     * get number of results corresponding to criteria
     *
     * This is much faster than counting the results of a find()
     * since count() doesn't populate Model object
     *
     * @param array $criteria
     *
     * @return int
     */
    public function count(array $criteria)
    {
        $query = $this->createQuery();

        foreach ($criteria as $field => $value) {
            $method = 'filterBy'.ucfirst($field);
            $query->$method($value);
        }

        return $query->count();
    }

}
