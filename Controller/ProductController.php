<?php

namespace Delivery\ApiBundle\Controller;

use Delivery\ApiBundle\Controller\Behaviour\ConstructTrait;
use Delivery\ApiBundle\Entity\Category;
use Delivery\ApiBundle\Entity\Image;
use Delivery\ApiBundle\Entity\Product;
use Delivery\ApiBundle\Form\ProductType;
use Delivery\ApiBundle\Manager\Image\ProductImageFileManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Product controller.
 *
 * @Route("products")
 */
class ProductController extends Controller
{
    use ConstructTrait;

    /**
     * Lists all product entities.
     *
     * @Route("/", name="products_list", methods={"GET"})
     */
    public function listAction()
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        $categories = $this->em->getRepository(Category::class)->findAll();

        return $this->json([
           "list" =>  $products,
           "selects" =>  [
               "categories" => $categories
           ],
        ]);
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new", methods={"POST"})
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function newAction(Request $request, ProductImageFileManager $fileManager)
    {
        $data = $request->request->all();

        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->submit($data);

        if ($form->isValid()) {
            $this->filesManagement($request, $product, $fileManager);
            $this->em->persist($product);
            $this->em->flush();

            return $this->json($product, Response::HTTP_CREATED);
        }

        return $this->json($form, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show", methods={"GET"})
     * @param Product $product
     * @return JsonResponse
     */
    public function showAction(Product $product)
    {
        return $this->json($product);
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit", methods={"POST"})
     * @param FormErrorNormalizer $normalizer
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function editAction(Request $request, Product $product, ProductImageFileManager $fileManager)
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->filesManagement($request, $product, $fileManager);
            $this->em->flush();

            return $this->json($product);
        }

        return $this->json($form, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}/delete", name="product_delete", methods={"DELETE"})
     * @param Product $product
     * @return JsonResponse
     */
    public function deleteAction(Product $product)
    {
        $this->em->remove($product);
        $this->em->flush();

        return $this->json([
            "status" => "ok",
        ]);
    }

    /**
     * Deletes an product image.
     *
     * @Route("/{id}/image/{image}", name="product_image_delete", methods={"DELETE"})
     * @param  $product Product
     * @param Image $image
     * @return JsonResponse
     */
    public function removeImageAction(Product $product, Image $image)
    {
        $product->removeImage($image);
        $this->em->flush();

        return $this->json([
            "status" => "ok",
        ]);
    }

    private function filesManagement($request, Product $product, ProductImageFileManager $fileManager) {
        if($defaultImage = $request->files->get('defaultImage')) {
            $image = $fileManager->upload($defaultImage, ['product' => $product]);
            $this->em->persist($image);
            $product->setDefaultImage($image);
        }
    }
}
