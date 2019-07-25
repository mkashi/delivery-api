<?php

namespace Delivery\ApiBundle\Entity\Localisation;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Delivery\ApiBundle\Repository\CityRepository")
 * @ORM\Table(name="city")
 */
class City
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
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
     * @ORM\Column(type="string", length=7, nullable=false)
     */
    private $zip;


    /**
     * @var Department
     *
     * @ORM\ManyToOne(targetEntity="Delivery\ApiBundle\Entity\Localisation\Department", inversedBy="cities")
     */
    private $department;

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
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->zip} - {$this->name}";
    }

    /**
     * @return Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param Department $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }
}