<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'hello'=>'Hola Mundo con Symfony 4'
        ]);
    }

    public function category($name,$description)
    {
    	$title = 'Bienvenido a la Pagina de Categorias';
    	$category = array('tecnlogia','automoviles','ropa','comida');//Aqui estoy defino un vector

    	return $this->render('home/category.html.twig', [

    		'title'=> $title,	
    		'name'=> $name,
    		'description'=> $description,
    		'category' =>	$category
    	]);
    }


    public function redirection()
    {
    	return $this->redirectToRoute('category',[
    		'name' => 'Deporte',
    		'description' => '1101010' 

    	]);


    }


}
