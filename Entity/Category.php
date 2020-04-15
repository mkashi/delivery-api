<?php

namespace Delivery\ApiBundle\Entity;

use Delivery\ApiBundle\Entity\Behaviour\PositionableTrait;
use Delivery\ApiBundle\Entity\Behaviour\PublishableTrait;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Delivery\ApiBundle\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category
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
     *
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=100)
     */
    private $name;

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

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     *
     * @ORM\Column(type="string", length=150, nullable=true, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Delivery\ApiBundle\Entity\Product", mappedBy="category")
     * @ORM\OrderBy({"position"="ASC"})
     */
    private $products;

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
     * @return Product[]
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param Product[] $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function addProducts($product)
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            return $this;
        }
    }

    /**
     * @param Product $product
     */
    public function removeProduct($product)
    {
        if (true === $this->products->contains($product)) {
            $this->products->removeElement($product);
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
}