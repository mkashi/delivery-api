<?php

namespace Delivery\ApiBundle\Service;

use Delivery\ApiBundle\Entity\Category;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Serializer\Serializer;

/**
 * Class RoutesFactoryService
 */
class RoutesFactoryService
{
    private $manager;
    private $serializer;

    /**
     * RoutesFactoryService constructor.
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager, Serializer $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    public function generateRoutesPages() {

        $categories = $this->manager->getRepository(Category::class)->findAll();

        $categories = $this->serializer->normalize($categories);

        $routes = [
          "root" => "categories",
          "pages" => $categories
        ];

        return $routes;
    }

    public function generateMenus() {

        /**
         * @var Category $categories
         */
        $categories = $this->manager->getRepository(Category::class)->findAll();

        $items = [[
            "title" => 'Gestion des catégories',
            "icon" => 'pages',
            "component" => [
                "path" => "/categories",
            ]
        ]];

        foreach ($categories as $category) {
            array_push($items, [
                "title" => $category->getName(),
                "name" => strtoupper($category->getName()),
                "component" => [
                    "path" => "/categories/" . $category->getId() . "/products",
                ]
            ]);
        }

        $data = array([
            "title" => "Categories",
            "group" => "categories",
            "icon" => "pages",
            "name" => "Categories",
            "component" => "categories",
            "items" => $items
        ]);

        return $data;
    }
}