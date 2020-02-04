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
    	
    	


        $products= $product_repo->findBy([], ['id'=>'DESC']); //Aqui obtengo todos Los 
        
    //Aqui sacaré todos los prodictos que hay adjunto a cada acategoria

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }


    //En esta función muestro los detalles de un producto es específico

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

            //Compruebo sin el formulario fue enviado y si es valido

            if($form->isSubmitted() && $form->isValid())
             {

                //var_dump($product);//aqui verifico los datos que vienen del formulario

                //Aqui cargo los datos que recibo de la vista (formulario) en un objeto para enviar a la bd (Guardo la categoría)

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            //return $this->redirectToRoute('products');

            //Esta es otra forma de redireccionar pasando (a la vista) por parametro el id del registro que se acaba de realizar 

            return $this->redirect($this->generateUrl('product_detail',['id'=>$product->getId()]));



             }   

             //Aqui sacaré todas las categorias que en la bd

             $category_repo = $this->getDoctrine()->getRepository(Category::class);         
             $categories = $category_repo->findAll();//Aqui saco todos las categorias directamenet desde la tabla de Category

             //Desta forma le paso el formulariio a la vista para que se pueeda mostrar

            return $this->render('product/creation.html.twig',[

                'form' => $form->createView()

            ]);      

    }


       //Aqui creo la funcion para editar productos

            public function edit(Request $request, product $product)
            {
        
                    //var_dump($product);


                   //Aqui renderiazamos una vista, y al mismo tiempo reutilzamos la vista creation y le pasamos varios (['edit'=> true]) para saber que estamos en la vista edit y no en la creación



                $form = $this->createForm(ProductType::class, $product);//aqui le pas el objeto $product para que dibuje el formulario

                $form->handleRequest($request);//uno lo que me llega por la petición del objeto

                //Compruebo sin el formulario fue enviado y si es valido

                if($form->isSubmitted() && $form->isValid())
                 {

                        //var_dump($product);//aqui verifico los datos que vienen del formulario

                        //Aqui cargo los datos que recibo de la vista (formulario) en un objeto para enviar a la bd (Guardo la categoría)

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($product);
                        $em->flush();

                    //return $this->redirectToRoute('products');

                    //Esta es otra forma de redireccionar pasando (a la vista) por parametro el id del registro que se acaba de realizar 

                    return $this->redirect($this->generateUrl('product_detail',['id'=>$product->getId()]));


                 }   

               
                    return $this->render('product/creation.html.twig', [
                    'edit'=> true,
                    'form'=> $form->createView()


                    ]); 

            } 

            //Aqui creo la función Eliminar

           public function delete(product $product)
           {

                if(!$product)
                {

                    return $this->redirectToRout('products');

                }    

                   $em = $this->getDoctrine()->getManager();
                   $em->remove($product);// Aqui lo borre de getDoctrine
                   $em->flush();//AQui lo borro de la base de datos

                   //Luego que elimino el producto redireciono a Producto

                   //return $this->redirectToRout('products');
                   return $this->redirect($this->generateUrl('products'));



           }
   
            



}
