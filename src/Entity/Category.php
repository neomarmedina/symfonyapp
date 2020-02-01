<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayColecction;
use Doctrine\Common\Collections\Colecction;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/") 
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     * @Assert\Regex("/[a-zA-Z ]+/")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="string", length=45, nullable=false)
     */
    private $activo;


    
    /**
        * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="category")

    */


    //Creo una propiedad privada para products

     private $products;// Aqui se guaradaran todos los productos


     //Ahora creo un constructor para  products 

     public function __construct()
     {

        //$this->products = new ArrayColecction();// Esto tendrá un array lleno de objetos de Doctrine, el cual va a ser rellenada por doctrine

     }
  

    public function getId(): ?int
    {
        return $this->id;
    }

    /*

    public function getId(): ?int
    {
        return $this->id;
    }
    
    */
    
    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getActivo(): ?string
    {
        return $this->activo;
    }

    public function setActivo(string $activo): self
    {
        $this->activo = $activo;

        return $this;
    }



    //Aqui creo  un metodo que retorna todos los products relacionados

    /**
     * @return Collecction|Product[]
     */

    public function getProducts()
    {

        return $this->products;

    }



}
