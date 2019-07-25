<?php

namespace Delivery\ApiBundle\Entity;

use Delivery\ApiBundle\Entity\Behaviour\PositionableTrait;
use Delivery\ApiBundle\Entity\Behaviour\PublishableTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Delivery\ApiBundle\Repository\ProductRepository")
 * @ORM\Table(name="product")
 */
class Product
{
    use PublishableTrait;
    use PositionableTrait;

    /**
     * @ORM\Column(type="string")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotBlank(message = "Champs requis")
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", scale=2, nullable=false)
     * @Assert\NotBlank(message = "Champs requis")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=false)
     * @Assert\NotBlank(message = "Champs requis")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Delivery\ApiBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
     * @ORM\OrderBy({"position"="ASC"})
     */
    private $category;

    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Delivery\ApiBundle\Entity\Image")
     */
    private $defaultImage;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPriceWithoutCents()
    {
        return floor($this->price);
    }

    /**
     * @return float
     */
    public function getCents() {
        return ($this->price - floor($this->price)) * 100;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param Product $product
     *
     * @return bool
     */
    public function equals(Product $product)
    {
        return $product->getId() == $this->getId();
    }

    /**
     * @return Image
     */
    public function getDefaultImage()
    {
        return $this->defaultImage;
    }

    /**
     * @param Image $defaultImage
     */
    public function setDefaultImage($defaultImage)
    {
        $this->defaultImage = $defaultImage;
    }
}