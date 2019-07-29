<?php

namespace Delivery\ApiBundle\Entity\Localisation;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Delivery\ApiBundle\Repository\DepartmentRepository")
 * @ORM\Table(name="department")
 */
class Department
{
    /**
     * @var string
     *
     * @ORM\Column(type="integer", length=4)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * Path or pathIdentifier. (can be a unique id, or a path, or a filename).
     *
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=4, nullable=false)
     */
    private $zip;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name", "zip"})
     *
     * @ORM\Column(type="string", length=150, nullable=true, unique=true)
     */
    private $slug;


    /**
     * @var City[]
     *
     * @ORM\OneToMany(targetEntity="Delivery\ApiBundle\Entity\Localisation\City", mappedBy="department")
     * @ORM\OrderBy({"zip"="ASC"})
     */
    private $cities;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        if (!$this->id) {
            $this->id = (int) $zip;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->zip} - {$this->name}";
    }

    /**
     * @return City[]
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param City[] $cities
     */
    public function setCities($cities)
    {
        $this->cities = $cities;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
}
