<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Category;
use App\Form\RegisterType;

//use Symfony\Component\Security\Core\Category\CategoryInterface;//probando si funciona la interfaz


class CategoryController extends AbstractController
{
   
    public function register(Request $request)
    {
        $category = new Category();

        //Aqui creo mi formulario	

        $form = $this->createForm(RegisterType::class, $category);

        $form->handleRequest($request);//Aqui uno lo que envia la requst con el objeto que tiene viculado el formulario

        //Y ahora compruebo si el formulario esta enviado y si si es afirmativo, recibo tola información o datos y ademas valido el forrmulario $form->isValid()

        if($form->isSubmitted() && $form->isValid())
        {

        	//var_dump($category);//Aquie chequeo que se esté enviando el formuñlario

        	//Aqui asigno un valor fijo de (booleano)

        	$category->setActivo('1');

        	//Aqui cargo los datos que recibo de la vista (formulario) en un objeto para enviar a la bd (Guardo la categoría)

        	$em = $this->getDoctrine()->getManager();
        	$em->persist($category);
        	$em->flush();

        	return $this->redirectToRoute('products');


        	

        }



        return $this->render('category/register.html.twig', [
          
        	'form'=> $form->createView()


        ]);
    }
}
