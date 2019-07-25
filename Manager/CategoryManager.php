<?php

namespace Delivery\ApiBundle\Manager;

use Delivery\ApiBundle\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CategoryManager
 */
class CategoryManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CategoryManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->em->getRepository(Category::class)->findBy(
            ['published' => 1],
            ['position' => 'ASC']
        );
    }

    /**
     * @return Category[]
     */
    public function getPublishedCategoriesAndProducts()
    {
        $qb = $this->em->createQueryBuilder()
            ->select('c', 'p')
            ->from(Category::class, 'c')
            ->leftJoin('c.products', 'p')
            ->where('c.published = 1')
            ->andWhere('p.published = 1 ')
            ->orderBy('c.position', 'ASC')
            ->addOrderBy('p.position', 'ASC')
        ;

        return $qb->getQuery()->getResult();
    }
}