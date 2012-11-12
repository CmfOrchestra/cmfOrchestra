<?php

namespace BootStrap\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
	public function buildForm(FormBuilder $builder, array $options)
	{
		parent::buildForm($builder, $options);

		// add your custom field

	}


	public function getName()
	{
		return 'bootstrap_user_profile';
	}

}