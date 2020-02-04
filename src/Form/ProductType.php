<?php

namespace App\Form;
			  
use Symfony\Component\Form\AbstractType;	

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Doctrine\ORM\EntityRepository;

class ProductType  extends AbstractType{


	public function buildForm(FormBuilderInterface $builder, array $options)
	{

		// Aqui me traigo los datos de la tabla category


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


			->add('category', EntityType::class, array(
				'class' => 'App:Category',
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('u')
						->orderBy('u.name', 'ASC');
				},
				'choice_label' => 'name'					

			))	
		
		


			->add('submit', SubmitType::class, array(
				'label'=> '...Crear...'

			));


		}

}

