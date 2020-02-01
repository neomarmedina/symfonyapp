<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\ProductType;

class ProductController extends AbstractController
{
    
    public function index()
    {
    	//Prueba de entidades  y relaciones

    	//Voy a intentar Sacar todos los productos con estas 3 lineas de codigo siguiente

    	// Aqui imprimo todas las categoŕía con su producto asociado
        $em = $this->getDoctrine()->getManager();
    	$product_repo = $this->getDoctrine()->getRepository(Product::class);//Aqui utilizo el repositorop de Repository
    	
    	$products= $product_repo->findBy([], ['id'=>'DESC']); //Aqui obtengo todos Los productos y los puedo rrecorrer con un foreach
        /*
    	
        foreach ($products as $product)
    	{
    		//echo $product->getName()."<br/>";// Aqui imprimo el nombre de todos productos de la bd
    		//echo $product->getCategory()->getName()."<br/>";
            echo $product->getCategory()->getName().'= '.$product->getName()."<br/>";
    	}
        */
        

        //Aqui sacare todos las categorias que hay en la bd
        /*
          $category_repo = $this->getDoctrine()->getRepository(Category::class);         
          $categories = $category_repo->findAll();//Aqui saco todos las categorias directamenet desde la tabla de Category


          foreach ($categories as $categorie)
        {
            //echo $product->getName()."<br/>";// Aqui imprimo el nombre de todos productos de la bd
            //echo $product->getCategory()->getName()."<br/>";
           // echo "<h1>{$categorie->getName()}={$categorie->getDescription()}</h1>";
        }
        */





        //Aqui sacaré todos los prodictos que hay adjunto a cada acategoria


        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }


    public function detail(product $product)
    {
        if(!$product)
        {

            return $this->redirectToRout('product');

        }
        else
        {


            return $this->render('product/detail.html.twig',[

                'product' => $product

            ]);
        }

    }


    public function creation(Request $request)
    {
        

            $product= new Product();
            $form = $this->createForm(ProductType::class, $product);//aqui le pas el objeto $product para que dibuje el formulario

            $form->handleRequest($request);//uno lo que me llega por la petición del objeto

            //Compruebo sin el formulario fue ennviado y si es valido

            if($form->isSubmitted() && $form->isValid())
             {

                var_dump($product);//aqui verifico los datos que vienen del formulario

             }   





             //Aqui sacaré todas las categorias que en la bd



             $category_repo = $this->getDoctrine()->getRepository(Category::class);         
             $categories = $category_repo->findAll();//Aqui saco todos las categorias directamenet desde la tabla de Category



             //Desta forma le paso el formulariio a la vista para que se pueeda mostrar

            return $this->render('product/creation.html.twig',[

                'form' => $form->createView()

            ]);
       

    }








}
