<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;	

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProductType  extends AbstractType{


	public function buildForm(FormBuilderInterface $builder, array $options)
	{

	$builder->add('code', TextType::class, array(
			'label'=> 'Codigo'

		))

		->add('name', TextType::class, array(
			'label'=> 'Nombre'

		))

		->add('description', TextareaType::class, array(
			'label'=> 'Descripción'

		))	

		->add('precio', TextType::class, array(
			'label'=> 'precio'

		))		

		->add('category', ChoyceType::class, array(
			'label'=> 'precio'

		))		

		->add('submit', SubmitType::class, array(
			'label'=> 'Registrarse'

		))


		;



	}





}