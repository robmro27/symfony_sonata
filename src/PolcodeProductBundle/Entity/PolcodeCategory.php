<?php

namespace PolcodeProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PolcodeCategory
 *
 * @ORM\Table(name="polcode_category")
 * @ORM\Entity(repositoryClass="PolcodeProductBundle\Repository\PolcodeCategoryRepository")
 */
class PolcodeCategory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PolcodeCategory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    
    /**
     * @ORM\OneToMany(targetEntity="PolcodeProduct", mappedBy="category")
     */
    private $products;

    public function __construct() {
        $this->products = new ArrayCollection();
    }
    

    /**
     * Add product
     *
     * @param \PolcodeProductBundle\Entity\PolcodeProduct $product
     *
     * @return PolcodeCategory
     */
    public function addProduct(\PolcodeProductBundle\Entity\PolcodeProduct $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \PolcodeProductBundle\Entity\PolcodeProduct $product
     */
    public function removeProduct(\PolcodeProductBundle\Entity\PolcodeProduct $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }
}
