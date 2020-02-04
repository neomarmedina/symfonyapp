<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\RegisterType;


class CategoryController extends AbstractController
{
   
    //Esta función me permite listar todas las categorías
      public function index()
    {
        

        $em = $this->getDoctrine()->getManager();

        $category_repo = $this->getDoctrine()->getRepository(Category::class);//Aqui utilizo el repositorop de Repository    

        $categories= $category_repo->findBy([], ['id'=>'DESC']); //Aqui obtengo todos Los productos y los puedo rrecorrer con un foreach
   

        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    //Esta función me permite mostrar los detalles de una Categoría en específica

    public function detail(category $category)
    {
        if(!$category)
        {

            return $this->redirectToRout('category');

        }
        else
        {


            return $this->render('category/detail.html.twig',[

                'category' => $category

            ]);
        }

    }      



    //Esta función me permite registrar las Categorías

    public function register(Request $request)
    {
        $category = new Category();

        //Aqui creo mi formulario	

        $form = $this->createForm(RegisterType::class, $category);

        $form->handleRequest($request);//Aqui uno(vinculo) lo que envia la request con el objeto que tiene viculado el formulario

        //Y ahora compruebo si el formulario esta enviado y si es afirmativo, recibo toda información o datos y ademas valido el forrmulario $form->isValid()

        if($form->isSubmitted() && $form->isValid())
        {

        	$category->setActivo('1');        	
        	$em = $this->getDoctrine()->getManager();
        	$em->persist($category);
        	$em->flush();

        	return $this->redirectToRoute('categories');

        }

        return $this->render('category/register.html.twig', [
          
        	'form'=> $form->createView()
        ]);
    }

       //Aqui creo la funcion para editar categorías

            public function edit(Request $request, category $category)
            {
        

                $form = $this->createForm(RegisterType::class, $category);//aqui le paso el objeto $category para que dibuje el formulario

                $form->handleRequest($request);//uno lo que me llega por la petición del objeto

                //Compruebo sin el formulario fue enviado y si es valido

                if($form->isSubmitted() && $form->isValid())
                 {

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($category);
                        $em->flush();

                    //Esta es otra forma de redireccionar pasando (a la vista) por parametro el id del registro que se acaba de realizar 

                    return $this->redirect($this->generateUrl('category_detail',['id'=>$category->getId()]));


                 }   
               
                    return $this->render('category/register.html.twig', [
                    'edit'=> true,
                    'form'=> $form->createView()

                    ]); 

            } 
    

            //Aqui creo la función Eliminar Categorías

           public function delete(category $category)
           {

                if(!$category)
                {

                    return $this->redirectToRout('categories');

                }    

                   $em = $this->getDoctrine()->getManager();
                   $em->remove($category);// Aqui lo borre de getDoctrine
                   $em->flush();//AQui lo borro de la base de datos

                   return $this->redirect($this->generateUrl('categories'));


           }
   








}
