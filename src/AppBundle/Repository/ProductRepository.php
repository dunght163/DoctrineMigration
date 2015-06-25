<?php

/**
 * Created by PhpStorm.
 * User: dunght163
 * Date: 6/17/15
 * Time: 11:38 AM
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    public function __contructor()
    {
        $em = $this->getEntityManager();

        parent::__construct($em, \AppBundle\Entity\Product::class);
    }

    /**
     * @param int $number
     * @return null|array
     */
    public function findTopProduct($number = 3) {
        $all = $this->findAll();

        if(!$all || count($all) < 1) {
            return null;
        }

        return array_slice($all, 0, $number);
    }
} 