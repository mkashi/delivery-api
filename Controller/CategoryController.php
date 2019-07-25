<?php

namespace Delivery\ApiBundle\Controller;


use Delivery\ApiBundle\Controller\Behaviour\ConstructTrait;
use Delivery\ApiBundle\Entity\Category;
use Delivery\ApiBundle\Entity\Product;
use Delivery\ApiBundle\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Category controller.
 *
 * @Route("categories")
 */
class CategoryController extends Controller
{
    use ConstructTrait;

    /**
     * Lists all category entities.
     *
     * @Route("/", name="categories_index", methods={"GET"})
     */
    public function listAction(EntityManagerInterface $em)
    {
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->json($categories);
    }

    /**
     * Creates a new category entity.
     *
     * @Route("/new", name="category_new", methods={"POST"})
     * @param FormErrorNormalizer $normalizer
     * @param Request $request
     * @return JsonResponse
     */
    public function newAction(Request $request, EntityManagerInterface $em)
    {
        $data = $request->request->all();

        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->submit($data);

        if ($form->isValid()) {
            $em->persist($category);
            $em->flush();

            return $this->json($category, Response::HTTP_CREATED);
        }

        return $this->json($form);

    }

    /**
     * Finds and displays a category entity.
     *
     * @Route("/{id}", name="category_show", methods={"GET"})
     * @param Category $category
     * @return JsonResponse
     */
    public function showAction(Category $category)
    {
        return $this->json($category);
    }

    /**
     * Edit an existing category entity.
     *
     * @Route("/{id}/edit", name="category_edit", methods={"POST"})
     * @param FormErrorNormalizer $normalizer
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function editAction(Request $request, Category $category)
    {
        $content = $request->request->all();

        $editForm = $this->createForm(CategoryType::class, $category);

        $editForm->submit($content);

        if ($editForm->isValid()) {
            $this->em->flush();
            return $this->json($category);
        }

        return $this->json($editForm);
    }

    /**
     * Deletes a category entity.
     *
     * @Route("/{id}/delete", name="category_delete", methods={"DELETE"})
     * @param Category $category
     * @return JsonResponse
     */
    public function deleteAction(Category $category)
    {
        $this->em->remove($category);
        $this->em->flush();

        return $this->json([
            'status' => 'ok'
        ]);
    }

    /**
     * Finds and displays products by category.
     *
     * @Route("/{id}/products", name="products_by_category", methods={"GET"})
     * @param $id
     * @return JsonResponse
     */
    public function productsByCategory($id)
    {
        $products = $this
            ->getDoctrine()
            ->getRepository(Product::class)
            ->findBy(["category" => $id]);

        return $this->json([
            "list" => $products,
            "selects" => [
                "categories" => $this->em->getRepository(Category::class)->findAll()
            ]
        ]);
    }
}
