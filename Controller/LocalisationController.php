<?php

namespace Delivery\ApiBundle\Controller;

use Delivery\ApiBundle\Controller\Behaviour\ConstructTrait;
use Delivery\ApiBundle\Entity\Category;
use Delivery\ApiBundle\Entity\Image;
use Delivery\ApiBundle\Entity\Localisation\Department;
use Delivery\ApiBundle\Entity\Product;
use Delivery\ApiBundle\Form\ProductType;
use Delivery\ApiBundle\Manager\Image\ProductImageFileManager;
use Delivery\ApiBundle\Repository\DepartmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Localisation controller.
 *
 * @Route("localisation")
 */
class LocalisationController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="departments_cities_list", methods={"GET"})
     */
    public function listDepartmentsAndCities(DepartmentRepository $departmentRepository)
    {
        return $this->json($departmentRepository->getDepartments(), 200, [], ['department.cities' => true]);
    }

    /**
     * @param Department $department
     *
     * @Route("/departments/{id}/cities", name="department_cities", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function listCitiesOfDepartment(Department $department)
    {
        return $this->json($department->getCities(), 200, [], ['department.cities' => true]);
    }

    /**
     * @param Department $department
     *
     * @Route("/departments/", name="departments_list", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function listDepartments(DepartmentRepository $departmentRepository)
    {
        return $this->json($departmentRepository->getDepartments());
    }
}
